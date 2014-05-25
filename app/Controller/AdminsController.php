<?php

/**
 * Description of owners_controller
 * Online Time Tracking Software For Mr. Robbie
 * @author Amit Chowdhury,amit3j2003@gmail.com(personal)
 */
class AdminsController extends AppController {

    public $name = "Admins";
    public $helpers = array('Html', 'Form', 'Paginator', 'Session');
    public $components = array('RequestHandler');
    public $uses = array("Job", "Tile", "User");

    public function index() {
        $this->layout = 'admin';
    }

    public function create_emp() {
        $this->layout = 'admin';
        $title = "Add Employee | TileClock";
        $this->set("title", $title);
        $emp_id = $this->viewVars['emp_id'];
        $user_type = $this->viewVars['user_type'];
        if ($user_type == 'admin') {
            if (!empty($this->request->data)) {
                $email = $this->request->data['User']['email_address'];
                $password = $this->request->data['User']['password'];
                $this->User->create();
                if ($this->User->save($this->request->data['User'])) {
                    $this->User->send_user_access($email, $password);
                    $this->Session->setFlash('The Employee has been created successfully', 'flash_okay');
                    $this->redirect(array('action' => 'create_emp'));
                } else {
                    $this->Session->setFlash('The Employee could not be saved. Please, try again.', 'flash_error');
                }
            }
        } else {
            $this->redirect('job_tile');
        }
    }

    public function employee_list() {
        $this->layout = 'admin';
        $title = "Employee List | TileClock";
        $this->set('title', $title);
        $emp_id = $this->viewVars['emp_id'];
        $user_type = $this->viewVars['user_type'];
        if ($user_type == 'admin') {
            if (isset($_POST['searchEmployee'])) {
                $firstName = $this->request->data['User']['first_name'];
                $lastName = $this->request->data['User']['last_name'];
                $hourlyRate = $this->request->data['User']['hourly_rate'];
                $condition = array();
                if ($firstName != '') {
                    $condition[] = array('User.created_by' => $emp_id, 'User.first_name' => $firstName, 'User.user_type' => 'user');
                }
                if ($lastName != '') {
                    $condition[] = array('User.created_by' => $emp_id, 'User.last_name' => $lastName, 'User.user_type' => 'user');
                }

                if ($hourlyRate != '') {
                    $condition[] = array('User.created_by' => $emp_id, 'User.hourly_rate' => $hourlyRate, 'User.user_type' => 'user');
                }

                $this->paginate = array(
                    'conditions' => $condition,
                    'order' => 'User.id DESC',
                    'limit' => 20,
                );
                $employeeList = $this->paginate('User');
                $this->set(compact('employeeList'));
            } else {
                $this->paginate = array(
                    'conditions' => array('User.created_by' => $emp_id, 'User.user_type' => 'user'),
                    'order' => 'User.id DESC',
                    'limit' => 20
                );
                $employeeList = $this->paginate('User');
                $this->set(compact('employeeList'));
            }
        } else {
            $this->redirect('job_tile');
        }
    }

    public function edit_emp($id = NULL) {
        $this->layout = 'admin';
        $title = "Edit Employee | TileClock";
        $this->set("title", $title);
        $emp_id = $this->viewVars['emp_id'];
        $user_type = $this->viewVars['user_type'];
        if ($user_type == 'admin') {
            if (!empty($this->request->data)) {
                if ($this->User->save($this->request->data['User'])) {
                    $this->Session->setFlash('Employee Successfully Edited.', 'flash_okay');
                    $this->redirect('employee_list');
                } else {
                    $this->Session->setFlash('Employee is not updated successfully!', 'flash_error');
                }
            } else {
                $this->User->id = $id;
                $this->data = $this->User->read();
            }
        } else {
            $this->redirect('job_tile');
        }
    }

    public function delete_emp($id = NULL) {
        $emp_id = $this->viewVars['emp_id'];
        $user_type = $this->viewVars['user_type'];
        if ($user_type == 'admin') {
            if (!$id) {
                $this->Session->setFlash('Invalid id!', 'flash_okay');
                $this->redirect('employee_list');
            } else {
                $this->User->id = $id;
                $this->User->saveField('status', 1);
                $this->Session->setFlash('Record deleted successfully', 'flash_okay');
                $this->redirect('employee_list');
            }
        } else {
            $this->redirect('job_tile');
        }
    }

    public function active_emp($id = NULL) {
        $emp_id = $this->viewVars['emp_id'];
        $user_type = $this->viewVars['user_type'];
        if ($user_type == 'admin') {
            if (!$id) {
                $this->Session->setFlash('Invalid id!', 'flash_okay');
                $this->redirect('employee_list');
            } else {
                $this->User->id = $id;
                $this->User->saveField('status', 0);
                $this->Session->setFlash('Record Activate successfully', 'flash_okay');
                $this->redirect('employee_list');
            }
        } else {
            $this->redirect('job_tile');
        }
    }

    public function add_job() {
        $this->layout = 'admin';
        $title = "Tiles | TileClock";
        $emp_id = $this->viewVars['emp_id'];
        $user_type = $this->viewVars['user_type'];
        if ($user_type == 'admin') {
            $this->Job->create();
            $this->Job->set($this->data);
            if (empty($this->data) == false) {
                if ($this->Job->save($this->data)) {
                    $this->Session->setFlash('Job created Successfully!.', 'flash_okay');
                    $this->redirect('add_job');
                }
            } else {
                $this->set('errors', $this->Job->invalidFields());
            }

            $this->paginate = array(
                'conditions' => array('Job.created_by' => $emp_id),
                'order' => 'Job.id DESC',
                'limit' => 20
            );
            $jobList = $this->paginate('Job');
            $this->set(compact('jobList', 'title'));
        } else {
            $this->redirect('add_job');
        }
    }

    public function delete_job($id = NULL) {
        $emp_id = $this->Session->read('User.id');
        $user_type = $this->Session->read('User.user_type');
        $emp_id = $this->viewVars['emp_id'];
        $user_type = $this->viewVars['user_type'];
        if ($user_type == 'admin') {
            if (!$id) {
                $this->Session->setFlash('Invalid id!', 'flash_okay');
                $this->redirect('add_job');
            } else {
                $this->Job->id = $id;
                $this->Job->saveField('status', 1);
                $this->Session->setFlash('Job deleted Successfully!.', 'flash_okay');
                $this->redirect('add_job');
            }
        } else {
            $this->redirect('job_tile');
        }
    }

    public function active_job($id = NULL) {
        $emp_id = $this->viewVars['emp_id'];
        $user_type = $this->viewVars['user_type'];
        if ($user_type == 'admin') {
            if (!$id) {
                $this->Session->setFlash('Invalid id!', 'flash_okay');
                $this->redirect('add_job');
            } else {
                $this->Job->id = $id;
                $this->Job->saveField('status', 0);
                $this->Session->setFlash('Job actived Successfully!.', 'flash_okay');
                $this->redirect('add_job');
            }
        } else {
            $this->redirect('job_tile');
        }
    }

    public function edit_job($id = NULL) {
        $this->layout = 'admin';
        $emp_id = $this->viewVars['emp_id'];
        $user_type = $this->viewVars['user_type'];
        if ($user_type == 'admin') {
            if (isset($_POST['edit'])) {
                if ($this->Job->save($this->data)) {
                    $this->Session->setFlash('Job Successfully Edited!.', 'flash_okay');
                    $this->redirect('add_job');
                } else {
                    $this->Session->setFlash('Not Updated', 'flash_error');
                }
            } else {
                $this->Job->id = $id;
                $this->data = $this->Job->read();
            }
        } else {
            $this->redirect('job_tile');
        }
    }

    public function job_tile() {
        $this->layout = 'admin';
        $title = "Tiles | TileClock";
        $emp_id = $this->viewVars['emp_id'];
        $user_type = $this->viewVars['user_type'];
        $created_by = $this->viewVars['created_by'];
        if ($user_type != 'admin') {
            $this->set('emp_id', $emp_id);

            $job_tile = $this->Job->find('all', array(
                'conditions' => array('Job.created_by' => $created_by, 'Job.status' => 0),
                'order' => 'Job.company_name ASC',
            ));
            $this->set('job_tile', $job_tile);

            $active = $this->Tile->find('first', array(
                'conditions' => array('Tile.status' => 1, 'Tile.emp_id' => $emp_id)
            ));
            $this->set(compact('active', 'title'));
        } else {
            $this->redirect('create_emp');
        }
    }

    function getJobId($jobId) {
        $emp_id = $this->viewVars['emp_id'];
        $statusNew = $this->Tile->find('all', array(
            'conditions' => array('Tile.job_id' => $jobId, 'Tile.status' => 1, 'Tile.emp_id' => $emp_id)
        ));
        return $statusNew;
    }

    public function timer() {
        $this->layout = 'ajax';
        $this->beforeRender();
        $this->autoRender = false;
        $job_id = $this->request->data['job_id'];
        $emp_id = $this->request->data['emp_id'];
        $time_new = explode(' ', $this->request->data['time_new']);
        $this->request->data['in_date'] = $time_new[0];
        $in_date = $this->request->data['in_time'];
        $created_by = $this->request->data['created_by'];
        $recordExist = $this->Tile->find('first', array(
            'conditions' => array('Tile.created_by' => $created_by, 'Tile.job_id' => $job_id, 'Tile.status' => 1, 'Tile.emp_id' => $emp_id
        )));
        $this->set('recordExist', $recordExist);
        $size = sizeof($recordExist);

        if (empty($recordExist)) {
            $check = $this->Tile->find('all', array(
                'conditions' => array('Tile.created_by' => $created_by, 'Tile.in_date' => $time_new[0], 'Tile.status' => 1, 'Tile.emp_id' => $emp_id
            )));
            $this->set('check', $check);
            if (empty($check)) {
                $this->Tile->save($this->data);
            } else {
                $this->Tile->updateAll(
                        array('Tile.out_date' => "'" . $time_new[0] . "'", 'Tile.out_time' => "'" . $in_date . "'", 'Tile.status' => 0), array(
                    'Tile.created_by' => $created_by, 'Tile.status' => 1, 'Tile.emp_id' => $emp_id
                        )
                );
                $this->Tile->save($this->data);
            }
            echo "Your timer has started!";
        } else {
            echo "Unable to start time,its already selected!";
        }
    }

    public function cancelTimer() {
        $this->layout = 'ajax';
        $this->beforeRender();
        $this->autoRender = false;
        $emp_id = $this->viewVars['emp_id'];
        $time = explode(' ', $this->request->data['time']);
        $this->request->data['out_date'] = $time[0];
        $this->request->data['out_time'] = $time[1] . " " . $time[2];
        $this->Tile->updateAll(
                array('Tile.out_date' => "'" . $time[0] . "'", 'Tile.out_time' => "'" . $this->request->data['out_time'] . "'", 'Tile.status' => 0), array(
            'Tile.status' => 1, 'Tile.emp_id' => $emp_id
                )
        );
        echo "Timer stopped succesfully,Thanks!";
    }

    public function report() {
        $this->layout = 'admin';
        $title = "Reports | TileClock";
        $emp_id = $this->viewVars['emp_id'];
        $user_type = $this->viewVars['user_type'];
        $created_by = $this->viewVars['created_by'];
        $this->set(compact('emp_id', 'user_type', 'title'));
        if ($user_type == 'admin') {
            $employee = $this->User->find('all', array(
                "fields" => array('User.id,User.first_name,User.last_name'),
                'conditions' => array('User.created_by' => $emp_id, 'User.status' => 0, 'User.user_type' => 'user')
            ));
        }
        /* else
          {
          $employee=$this->User->find('all',array(
          "fields"=>array('User.id,User.first_name,User.last_name'),
          'conditions'=>array('User.created_by'=>$created_by,'User.status'=>0,'User.user_type'=>'user','User.id'=>$emp_id)
          ));
          } */

        $employee = Set::combine($employee, '{n}.User.id', array('{0} {1}', '{n}.User.first_name', '{n}.User.last_name'));

        $job = $this->Job->find('list', array(
            "fields" => 'id,company_name',
            'conditions' => array('Job.created_by' => $created_by),
            'order' => array('Job.company_name' => 'ASC')
        ));
        $this->set(compact('employee', 'job'));

        if (isset($this->request->data['search'])) {
            $from = $this->request->data['Tile']['from'];
            $to = $this->request->data['Tile']['to'];
            $emp = $this->request->data['Tile']['emp_id'];
            $job_id = $this->request->data['Tile']['job_id'];

            $condition = array();
            if ($from != '') {
                $condition[] = array('User.created_by' => $created_by, 'Tile.in_date >=' => $from);
                $this->set('from', $from);
            }

            if ($to != '') {
                $condition[] = array('User.created_by' => $created_by, 'Tile.in_date <=' => $to);
                $this->set('to', $to);
            }

            if ($emp != '') {
                $condition[] = array('User.created_by' => $created_by, 'Tile.emp_id' => $emp);
                $this->set('emp', $emp);
            }

            if ($from != "" && $to != "" && $emp == "" && $job_id == "") {
                $tile = $this->Tile->find('all', array(
                    'conditions' => array('User.created_by' => $created_by, 'Tile.in_date >=' => $from,
                        'Tile.in_date <=' => $to,
                )));
                $page = "no_paging";
                $this->set('page', $page);
            } elseif ($from != "" && $to != "" && $emp != "" && $job_id == "") {
                $tile = $this->Tile->find('all', array(
                    'conditions' => array('User.created_by' => $created_by, 'Tile.in_date >=' => $from,
                        'Tile.in_date <=' => $to,
                        'Tile.emp_id' => $emp
                )));
                $page = "no_paging";
                $this->set('page', $page);
            } 
            elseif ($from != "" && $to != "" && $emp != "" && $job_id != "") {
                $tile = $this->Tile->find('all', array(
                    'conditions' => array('User.created_by' => $created_by, 'Tile.in_date >=' => $from,
                        'Tile.in_date <=' => $to,
                        'Tile.emp_id' => $emp,
                        'Tile.job_id' => $job_id
                    ), 'order' => 'Tile.id DESC',
                ));
                $page = "no_paging";
                $this->set('page', $page);
            } 
            elseif ($from != "" && $to != "" && $emp == "" && $job_id != "") {
                $tile = $this->Tile->find('all', array(
                    'conditions' => array('User.created_by' => $created_by, 'Tile.in_date >=' => $from,
                        'Tile.in_date <=' => $to,
                        'Tile.job_id' => $job_id
                    ), 'order' => 'Tile.id DESC',
                ));
                $page = "no_paging";
                $this->set('page', $page);
            } 
            elseif ($from == "" && $to == "" && $emp == "" && $job_id != "") {
                $tile = $this->Tile->find('all', array(
                    'conditions' => array('User.created_by' => $created_by, 'Tile.job_id' => $job_id
                    ), 'order' => 'Tile.id DESC',
                ));
                $page = "no_paging";
                $this->set('page', $page);
            } 
            elseif ($from == "" && $to == "" && $emp != "" && $job_id != "") {
                $tile = $this->Tile->find('all', array(
                    'conditions' => array('User.created_by' => $created_by, 'Tile.job_id' => $job_id,
                        'Tile.emp_id' => $emp
                    ), 'order' => 'Tile.id DESC',
                ));
                $page = "no_paging";
                $this->set('page', $page);
            } 
            else {
                $this->paginate = array(
                    'conditions' => $condition,
                    'order' => 'Tile.id DESC',
                    'limit' => 30,
                );
                $tile = $this->paginate('Tile');
                $page = "paging";
                $this->set('page', $page);
            }
            $this->set(compact('tile'));
            $count = sizeof($tile);
            $this->set('count', $count);

            if (!empty($emp)) {
                if (!empty($tile)) {
                    $emp_name = $tile[0]['User']['first_name'] . " " . $tile[0]['User']['last_name'];
                } else {
                    $emp_name = "empty";
                }
                $this->set('emp_name', $emp_name);
            }
        } 
        else {
            $date = date('Y-m-d');
            $firstDay = date('Y-m-01');
            $lastDay = date("Y-m-t", strtotime($date));
            //if($user_type=='admin')
            //{
            //$this->paginate = array(
            //'conditions'=>array('Tile.created_by'=>$created_by,'Tile.in_date >='=>$firstDay,'Tile.in_date <='=>$lastDay),
            //'order' =>'Tile.id DESC',
            //'limit' => 30,
            //);
            //}
            //else
            //{
            $this->paginate = array(
                'conditions' => array('Tile.created_by' => $created_by, 'Tile.in_date >=' => $firstDay, 'Tile.in_date <=' => $lastDay),
                'order' => 'Tile.id DESC',
                'limit' => 30,
            );
            //}
            $tile = $this->paginate('Tile');
            $this->set(compact('tile'));
            $count = sizeof($tile);
            $this->set('count', $count);
            $pageCount = $this->params['paging']['Tile']['pageCount'];
            if ($pageCount > 0) {
                $page = "paging";
            } else {
                $page = "no_paging";
            }
            $this->set('page', $page);
            
        }
    }

    public function edit_time($id = NULL) {
        $this->layout = 'admin';
        $emp_id = $this->viewVars['emp_id'];
        $user_type = $this->viewVars['user_type'];
        $title = "Edit Report | TileClock";
        $this->set("title", $title);
        if ($user_type == 'admin') {
            if (isset($_POST['edit'])) {
                $tile = $this->Tile->find('first', array(
                    'conditions' => array('Tile.id' => $id)
                ));
                $this->set('tile', $tile);

                $in_date = $this->request->data['Tile']['in_date'];
                $in_hr = $this->request->data['Tile']['in_hr'];
                $in_min = $this->request->data['Tile']['in_min'];
                $in_sec = $this->request->data['Tile']['in_sec'];
                $in_type = $this->request->data['Tile']['in_type'];
                $in_time = $in_hr . ":" . $in_min . ":" . $in_sec . " " . $in_type;
                $this->request->data['Tile']['in_time'] = $in_time;

                $out_date = $this->request->data['Tile']['out_date'];
                $out_hr = $this->request->data['Tile']['out_hr'];
                $out_min = $this->request->data['Tile']['out_min'];
                $out_sec = $this->request->data['Tile']['out_sec'];
                $out_type = $this->request->data['Tile']['out_type'];
                $out_time = $out_hr . ":" . $out_min . ":" . $out_sec . " " . $out_type;
                $this->request->data['Tile']['out_time'] = $out_time;

                if ($in_hr == "") {
                    $this->Session->setFlash('All are required fields!.', 'flash_error');
                } elseif ($in_min == "") {
                    $this->Session->setFlash('All are required fields!.', 'flash_error');
                } elseif ($in_sec == "") {
                    $this->Session->setFlash('All are required fields!.', 'flash_error');
                }
                if ($out_hr == "") {
                    $this->Session->setFlash('All are required fields!.', 'flash_error');
                } elseif ($out_min == "") {
                    $this->Session->setFlash('All are required fields!.', 'flash_error');
                } elseif ($out_sec == "") {
                    $this->Session->setFlash('All are required fields!.', 'flash_error');
                } else {
                    $this->Tile->save($this->data);
                    $this->Session->setFlash('Job Edited Successfully Edited!.', 'flash_okay');
                    $this->redirect('report');
                }
            } else {
                $tile = $this->Tile->find('first', array(
                    'conditions' => array('Tile.id' => $id)
                ));
                $this->set('tile', $tile);
            }
        } else {
            $this->redirect('report');
        }
    }

    public function delete_time($id = NULL) {
        $emp_id = $this->viewVars['emp_id'];
        $user_type = $this->viewVars['user_type'];
        if ($user_type == 'admin') {
            if (!$id) {
                $this->Session->setFlash('Invalid id!', 'flash_okay');
                $this->redirect('add_job');
            } else {
                $this->Tile->id = $id;
                $this->Tile->delete($this->request->data('Tile.id'));
                $this->Session->setFlash('Job deleted Successfully!.', 'flash_okay');
                $this->redirect('report');
            }
        } else {
            $this->redirect('report');
        }
    }

    public function feedback() {
        $this->layout = 'admin';
        $title = "Feedback | TileClock";
        $this->set('title', $title);
    }

}
heeeeeee
?>