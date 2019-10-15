<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing_adjustments extends CORE_Controller
{
    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Billing_adjustments_model');
        $this->load->model('Users_model');
        $this->load->model('Trans_model');
        $this->load->library('M_pdf');
    }

    public function index() {
        $this->Users_model->validate();
        //default resources of the active view
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['title'] = 'Billing Adjustments for Approval';
        (in_array('20',$this->session->parent_rights)? 
        $this->load->view('billing_adjustments_view', $data)
        :redirect(base_url('dashboard')));
    }

    function transaction($txn = null,$id_filter=null) {
        switch ($txn){
            case 'list':  //this returns JSON of Purchase Order to be rendered on Datatable

                $is_approved=$this->input->get('is_approved',TRUE);
                $filter =  "b_adjustments.is_deleted = FALSE AND b_adjustments.is_approved = $is_approved";
                $response['data'] = $this->Billing_adjustments_model->get_list($filter,
                    'b_adjustments.*,
                    IFNULL(b_adjustments.notes,"") as notes,
                    IF(b_adjustments.adjustment_type = "1","OUT","IN") as adjustment_type,
                    b_tenants.trade_name,
                    b_refcharges.charge_desc,
                    CONCAT(DATE(b_refbillingperiod.period_start_date)," - ",DATE(b_refbillingperiod.period_end_date)) as period_date,
                    CONCAT(b_refmonths.month_name," ",b_adjustments.app_year) as period_desc',
                    array(
                        array('b_tenants','b_tenants.tenant_id=b_adjustments.tenant_id','left'),
                        array('b_refmonths','b_refmonths.month_id=b_adjustments.month_id','left'),
                        array('b_refbillingperiod','b_refbillingperiod.period_id=b_adjustments.period_id','left'),
                        array('b_refcharges','b_refcharges.charge_id=b_adjustments.charge_id','left')
                    )
                    );
                echo json_encode($response);
            break;



            case 'mark-approved': //called on DASHBOARD when approved button is clicked
                $m_adjustment=$this->Billing_adjustments_model;
                $adjustment_id=$this->input->post('adjustment_id',TRUE);
                $m_adjustment->is_approved=1; //1 means approved
                if($m_adjustment->modify($adjustment_id)){
                    $adjustment_info = $m_adjustment->get_list($adjustment_id,'adjustment_no')[0];
                    $m_trans=$this->Trans_model;
                    $m_trans->user_id=$this->session->user_id;
                    $m_trans->set('trans_date','NOW()');
                    $m_trans->trans_key_id=11; //CRUD
                    $m_trans->trans_type_id=74; // TRANS TYPE
                    $m_trans->trans_log='Approved Billing '.$adjustment_info->adjustment_no.' ID('.$adjustment_id.')';
                    $m_trans->save();

                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Billing Adjustment Successfully Approved.';
                    echo json_encode($response);
                }
            break;

            case 'mark-disapproved': //called on DASHBOARD when approved button is clicked
                $m_adjustment=$this->Billing_adjustments_model;
                $adjustment_id=$this->input->post('adjustment_id',TRUE);
                $m_adjustment->is_approved=2; //1 means approved
                if($m_adjustment->modify($adjustment_id)){
                    $adjustment_info = $m_adjustment->get_list($adjustment_id,'adjustment_no')[0];
                    $m_trans=$this->Trans_model;
                    $m_trans->user_id=$this->session->user_id;
                    $m_trans->set('trans_date','NOW()');
                    $m_trans->trans_key_id=12; //CRUD
                    $m_trans->trans_type_id=74; // TRANS TYPE
                    $m_trans->trans_log='Disapproved Billing '.$adjustment_info->adjustment_no.' ID('.$adjustment_id.')';
                    $m_trans->save();

                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Billing Adjustment Successfully Disapproved.';
                    echo json_encode($response);
                }
            break;
        }
    }
}


 
