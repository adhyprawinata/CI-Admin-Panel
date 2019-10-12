<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menubar');
        $this->load->view('home/dashboard');
        $this->load->view('templates/footer');
    }

    public function menu_management()
    {
        $data['title'] = 'Menu Management';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menubar');
        $this->load->view('admin/menu-management');
        $this->load->view('templates/footer');
    }

    public function sub_menu_management()
    {
        $data['title'] = 'Sub Menu Management';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menubar');
        $this->load->view('admin/sub-menu-management');
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menubar');
        $this->load->view('admin/role');
        $this->load->view('templates/footer');
    }

    public function role_access($role_id)
    {
        $data['title'] = 'Role';

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menubar');
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function sub_menu_mng_add()
    {
        $data['title'] = 'Sub Menu Management';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menubar');
        $this->load->view('admin/sub-menu-management-add');
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', 'Access Changed!');
    }

    public function getlistrole()
    {
        $sql = "SELECT * FROM user_role";
        $query = $this->db->query($sql)->result_array();
        $index = 1;
        if (isset($query[0]['id'])) {
            foreach ($query as $row) {
                $json['data'][] = array(
                    'no' => $index,
                    'id' => $row['id'],
                    'role' => $row['role'],
                    'action' => '<a href="role_access/' . $row['id'] . '" class="btn btn-icon icon-left btn-primary btn-sm"><i class="far fa-edit"></i> Access</a>'
                );
                $index++;
            }
        } else {
            $json['data'] = array();
        }

        echo json_encode($json);
        die;
    }

    public function getMenuID()
    {
        $sql = "select * from user_menu";
        $query = $this->db->query($sql)->result_array();
        echo json_encode($query);
    }

    public function getlistmenu()
    {
        $sql = "SELECT * FROM user_menu";
        $query = $this->db->query($sql)->result_array();
        $index = 1;
        if (isset($query[0]['id'])) {
            foreach ($query as $row) {
                $json['data'][] = array(
                    'no' => $index,
                    'id' => $row['id'],
                    'menu' => $row['menu'],
                    'action' => '<a href="#" class="btn btn-icon icon-left btn-primary btn-sm"><i class="far fa-edit"></i> Edit</a>'
                );
                $index++;
            }
        } else {
            $json['data'] = array();
        }

        echo json_encode($json);
        die;
    }

    public function getlistsubmenu()
    {
        $sql = "SELECT user_menu.menu
                , user_sub_menu.title
                , user_sub_menu.url
                , user_sub_menu.icon
                , case when user_sub_menu.is_active = '1' then 'Active' 
                when user_sub_menu.is_active = '0' then 'Non Active' end as status
                FROM user_sub_menu
                JOIN user_menu ON user_sub_menu.menu_id = user_menu.id";
        $query = $this->db->query($sql)->result_array();
        $index = 1;
        if (isset($query[0]['menu'])) {
            foreach ($query as $row) {
                $json['data'][] = array(
                    'no' => $index,
                    'menu' => $row['menu'],
                    'title' => $row['title'],
                    'url' => $row['url'],
                    'icon' => $row['icon'],
                    'is_active' => '<div class="badge badge-success">' . $row['status'] . '</div>',
                    'action' => '<a href="#" class="btn btn-icon icon-left btn-primary btn-sm"><i class="far fa-edit"></i> Edit</a>'
                );
                $index++;
            }
        } else {
            $json['data'] = array();
        }

        echo json_encode($json);
        die;
    }

    public function save_sub_menu_mng()
    {
        if (isset($_POST['title'])) {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', 'New sub menu added!');
            redirect('admin/sub_menu_management');
        }
    }
}
