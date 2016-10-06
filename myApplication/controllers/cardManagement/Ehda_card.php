<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Ehda_card extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('users/users_model');
        }

        public function index()
        {
            // index
            show_404();
            exit;
        }

        public function miniCard($rand)
        {
            ini_set("error_reporting","E_ALL & ~E_NOTICE & ~E_STRICT");
            $this->load->helper('fagd');

            $user = $this->users_model->getOneUserByRand($rand);
            if($user AND $this->users_model->is_user())
            {
                $id = $user['memberID'];
                // Set the content-type
                header("Content-type: image/png");
                header('Content-Disposition: filename=' . $id);

                $img = imagecreatefrompng(asset_url() . 'images/cardMini.png');

                // Create some colors
                $black = imagecolorallocate($img, 0, 0, 0);

                // The text to draw
                $nameN = fagd($user['data']['firstName'] . ' ' . $user['data']['lastName'],'fa','nastaligh');
                $fnameN = fagd($user['data']['fatherName'],'fa','nastaligh');
                // Replace path by your own font path

                $font = dirname(dirname(dirname(dirname(__FILE__)))) . '/assets/fonts/php/BNazanin.ttf';
                $enFont = dirname(dirname(dirname(dirname(__FILE__)))) . '/assets/fonts/php/calibri.ttf';

                // Add some shadow to the text
                //imagettftext($im, 20, 0, 19, 26, $grey, $font, $text);

                // Add the text
                imagettftext($img, 25, 0, (540 - (strlen($id) * 19)), 173, $black, $font, $id);
                imagettftext($img, 25, 0, (520 - (strlen($user['data']['firstName'] . ' ' . $user['data']['lastName']) * 8)), 212, $black, $font, $nameN);
                imagettftext($img, 25, 0, (560 - (strlen($user['data']['fatherName']) * 9)), 254, $black, $font, $fnameN);
                imagettftext($img, 25, 0, (540 - (strlen($user['nationalcode']) * 19)), 300, $black, $font, $user['nationalcode']);
                imagettftext($img, 25, 0, (540 - (strlen(pdate('Y/m/d', $user['data']['dateOfBirth'])) * 17)), 341, $black, $font, pdate('Y/m/d', $user['data']['dateOfBirth']));
                imagettftext($img, 25, 0, (540 - (strlen(pdate('Y/m/d', $user['data']['registerTime'])) * 17)), 382, $black, $font, pdate('Y/m/d', $user['data']['registerTime']));

                // Using imagepng() results in clearer text compared with imagejpeg()
                imagepng($img);
                imagedestroy($img);
            }
            else
            {
                // Set the content-type                
                header("Content-type: image/png");
                header('Content-Disposition: filename= Card_Not_Found');

                $img = imagecreatefrompng(asset_url() . 'images/cardMiniNotFound.png');

                imagepng($img);
                imagedestroy($img);
            }


        }

        public function fullCard($rand, $mode = 'print', $extra = FALSE)
        {
            ini_set("error_reporting","E_ALL & ~E_NOTICE & ~E_STRICT");
            $this->load->helper('fagd');

            $user = $this->users_model->getOneUserByRand($rand);
            if($user AND $this->users_model->is_user())
            {
                $id = $user['memberID'];
                // Set the content-type
                header("Content-type: image/png");

                if($mode == 'print')
                {
                    header('Content-Disposition: filename=' . $id);
                }
                elseif($mode == 'download')
                {
                    header('Content-Description: File Transfer');
                    header('Content-Disposition: attachment; filename='."$id.png");
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                }
                else
                {
                    header('Content-Disposition: filename=' . $id);
                }

                $img = imagecreatefrompng(asset_url() . 'images/finalCart.png');

                // Create some colors
                $black = imagecolorallocate($img, 0, 0, 0);

                // The text to draw
                $nameN = fagd($user['data']['firstName'] . ' ' . $user['data']['lastName'],'fa','nastaligh');
                $fnameN = fagd($user['data']['fatherName'],'fa','nastaligh');
                // Replace path by your own font path

                $font = dirname(dirname(dirname(dirname(__FILE__)))) . '/assets/fonts/php/BNazanin.ttf';
                $enFont = dirname(dirname(dirname(dirname(__FILE__)))) . '/assets/fonts/php/calibri.ttf';

                // Add the text
                imagettftext($img, 30, 0, (880 - (strlen($id) * 19)), 565, $black, $font, $id);
                imagettftext($img, 30, 0, (850 - (strlen($user['data']['firstName'] . ' ' . $user['data']['lastName']) * 8)), 616, $black, $font, $nameN);
                imagettftext($img, 30, 0, (930 - (strlen($user['data']['fatherName']) * 8)), 665, $black, $font, $fnameN);
                imagettftext($img, 30, 0, (880 - (strlen($user['nationalcode']) * 19)), 720, $black, $font, $user['nationalcode']);
                imagettftext($img, 30, 0, (880 - (strlen(pdate('Y/m/d', $user['data']['dateOfBirth'])) * 16)), 772, $black, $font, pdate('Y/m/d', $user['data']['dateOfBirth']));
                imagettftext($img, 30, 0, (880 - (strlen(pdate('Y/m/d', $user['data']['registerTime'])) * 16)), 822, $black, $font, pdate('Y/m/d', $user['data']['registerTime']));
                imagettftext($img, 40, 0, (1700 - (strlen($user['data']['username']) * 16)), 2112, $black, $enFont, $user['username']);
                imagettftext($img, 40, 0, (1700 - (strlen($user['email']) * 22)), 2185, $black, $enFont, $user['email']);

                // Using imagepng() results in clearer text compared with imagejpeg()
                imagepng($img);
                imagedestroy($img);
            }
            else
            {
                // Set the content-type                
                header("Content-type: image/png");
                header('Content-Disposition: filename= Card_Not_Found');

                $img = imagecreatefrompng(asset_url() . 'images/cardMiniNotFound.png');

                imagepng($img);
                imagedestroy($img);
            }


        }

        public function fullCardPrint($rand)
        {
            $data['rand'] = $rand;
            $this->load->view('card/printCard', $data);
        }

        public function printGroup()
        {
            ini_set("error_reporting","E_ALL & ~E_NOTICE & ~E_STRICT");
            $this->load->helper('fagd');


            $id = htmlCoding($this->input->get('id'));
            if(!$id OR strlen($id) < 1)
            {
                redirect(base_url('safir'));
                exit;
            }
            else
            {
                if(strpos($id, ','))
                {
                    $ids = explode(',', $id);
                }
                else
                {
                    $ids[0] = $id;
                }

                for($i = 0; $i < count($ids); $i++)
                {
                    $users[] = $this->users_model->selectUserByID($ids[$i]);
                }

                if(count($users > 0))
                {

                    // set image config
                    header("Content-type: image/png");
                    header('Content-Disposition: filename=' . $id);
                    $img = imagecreatefrompng(asset_url() . 'images/printGroup.png');
                    // Create some colors
                    $black = imagecolorallocate($img, 0, 0, 0);
                    $font = dirname(dirname(dirname(dirname(__FILE__)))) . '/assets/fonts/php/BNazanin.ttf';
                    $enFont = dirname(dirname(dirname(dirname(__FILE__)))) . '/assets/fonts/php/calibri.ttf';


                    for($a = 0; $a < count($users); $a++)
                    {
                        if($a == 0)
                        {
                            $id = $users[$a]['memberID'];
                            // The text to draw
                            $nameN = fagd($users[$a]['data']['firstName'] . ' ' . $users[$a]['data']['lastName'],'fa','nastaligh');
                            $fnameN = fagd($users[$a]['data']['fatherName'],'fa','nastaligh');

                            // Add the text
                            imagettftext($img, 30, 0, (890 - (strlen($id) * 19)), 595, $black, $font, $id);
                            imagettftext($img, 30, 0, (875 - (strlen($users[$a]['data']['firstName'] . ' ' . $users[$a]['data']['lastName']) * 8)), 650, $black, $font, $nameN);
                            imagettftext($img, 30, 0, (930 - (strlen($users[$a]['data']['fatherName']) * 8)), 710, $black, $font, $fnameN);
                            imagettftext($img, 30, 0, (930 - (strlen($users[$a]['nationalcode']) * 19)), 775, $black, $font, $users[$a]['nationalcode']);
                            imagettftext($img, 30, 0, (930 - (strlen(pdate('Y/m/d', $users[$a]['data']['dateOfBirth'])) * 16)), 830, $black, $font, pdate('Y/m/d', $users[$a]['data']['dateOfBirth']));
                        }
                        elseif($a == 1)
                        {
                            $id = $users[$a]['memberID'];
                            // The text to draw
                            $nameN = fagd($users[$a]['data']['firstName'] . ' ' . $users[$a]['data']['lastName'],'fa','nastaligh');
                            $fnameN = fagd($users[$a]['data']['fatherName'],'fa','nastaligh');

                            // Add the text
                            imagettftext($img, 30, 0, (1920 - (strlen($id) * 19)), 585, $black, $font, $id);
                            imagettftext($img, 30, 0, (1905 - (strlen($users[$a]['data']['firstName'] . ' ' . $users[$a]['data']['lastName']) * 8)), 640, $black, $font, $nameN);
                            imagettftext($img, 30, 0, (1960 - (strlen($users[$a]['data']['fatherName']) * 8)), 700, $black, $font, $fnameN);
                            imagettftext($img, 30, 0, (1960 - (strlen($users[$a]['nationalcode']) * 19)), 770, $black, $font, $users[$a]['nationalcode']);
                            imagettftext($img, 30, 0, (1960 - (strlen(pdate('Y/m/d', $users[$a]['data']['dateOfBirth'])) * 16)), 825, $black, $font, pdate('Y/m/d', $users[$a]['data']['dateOfBirth']));
                        }
                        elseif($a == 2)
                        {
                            $id = $users[$a]['memberID'];
                            // The text to draw
                            $nameN = fagd($users[$a]['data']['firstName'] . ' ' . $users[$a]['data']['lastName'],'fa','nastaligh');
                            $fnameN = fagd($users[$a]['data']['fatherName'],'fa','nastaligh');

                            // Add the text
                            imagettftext($img, 30, 0, (890 - (strlen($id) * 19)), 1295, $black, $font, $id);
                            imagettftext($img, 30, 0, (875 - (strlen($users[$a]['data']['firstName'] . ' ' . $users[$a]['data']['lastName']) * 8)), 1350, $black, $font, $nameN);
                            imagettftext($img, 30, 0, (930 - (strlen($users[$a]['data']['fatherName']) * 8)), 1410, $black, $font, $fnameN);
                            imagettftext($img, 30, 0, (930 - (strlen($users[$a]['nationalcode']) * 19)), 1475, $black, $font, $users[$a]['nationalcode']);
                            imagettftext($img, 30, 0, (930 - (strlen(pdate('Y/m/d', $users[$a]['data']['dateOfBirth'])) * 16)), 1535, $black, $font, pdate('Y/m/d', $users[$a]['data']['dateOfBirth']));
                        }
                        elseif($a == 3)
                        {
                            $id = $users[$a]['memberID'];
                            // The text to draw
                            $nameN = fagd($users[$a]['data']['firstName'] . ' ' . $users[$a]['data']['lastName'],'fa','nastaligh');
                            $fnameN = fagd($users[$a]['data']['fatherName'],'fa','nastaligh');

                            // Add the text
                            imagettftext($img, 30, 0, (1920 - (strlen($id) * 19)), 1285, $black, $font, $id);
                            imagettftext($img, 30, 0, (1905 - (strlen($users[$a]['data']['firstName'] . ' ' . $users[$a]['data']['lastName']) * 8)), 1340, $black, $font, $nameN);
                            imagettftext($img, 30, 0, (1960 - (strlen($users[$a]['data']['fatherName']) * 8)), 1405, $black, $font, $fnameN);
                            imagettftext($img, 30, 0, (1960 - (strlen($users[$a]['nationalcode']) * 19)), 1470, $black, $font, $users[$a]['nationalcode']);
                            imagettftext($img, 30, 0, (1960 - (strlen(pdate('Y/m/d', $users[$a]['data']['dateOfBirth'])) * 16)), 1535, $black, $font, pdate('Y/m/d', $users[$a]['data']['dateOfBirth']));
                        }
                        elseif($a == 4)
                        {
                            $id = $users[$a]['memberID'];
                            // The text to draw
                            $nameN = fagd($users[$a]['data']['firstName'] . ' ' . $users[$a]['data']['lastName'],'fa','nastaligh');
                            $fnameN = fagd($users[$a]['data']['fatherName'],'fa','nastaligh');

                            // Add the text
                            imagettftext($img, 30, 0, (890 - (strlen($id) * 19)), 1985, $black, $font, $id);
                            imagettftext($img, 30, 0, (875 - (strlen($users[$a]['data']['firstName'] . ' ' . $users[$a]['data']['lastName']) * 8)), 2055, $black, $font, $nameN);
                            imagettftext($img, 30, 0, (930 - (strlen($users[$a]['data']['fatherName']) * 8)), 2110, $black, $font, $fnameN);
                            imagettftext($img, 30, 0, (930 - (strlen($users[$a]['nationalcode']) * 19)), 2180, $black, $font, $users[$a]['nationalcode']);
                            imagettftext($img, 30, 0, (930 - (strlen(pdate('Y/m/d', $users[$a]['data']['dateOfBirth'])) * 16)), 2235, $black, $font, pdate('Y/m/d', $users[$a]['data']['dateOfBirth']));
                        }
                        elseif($a == 5)
                        {
                            $id = $users[$a]['memberID'];
                            // The text to draw
                            $nameN = fagd($users[$a]['data']['firstName'] . ' ' . $users[$a]['data']['lastName'],'fa','nastaligh');
                            $fnameN = fagd($users[$a]['data']['fatherName'],'fa','nastaligh');

                            // Add the text
                            imagettftext($img, 30, 0, (1920 - (strlen($id) * 19)), 1975, $black, $font, $id);
                            imagettftext($img, 30, 0, (1905 - (strlen($users[$a]['data']['firstName'] . ' ' . $users[$a]['data']['lastName']) * 8)), 2040, $black, $font, $nameN);
                            imagettftext($img, 30, 0, (1960 - (strlen($users[$a]['data']['fatherName']) * 8)), 2100, $black, $font, $fnameN);
                            imagettftext($img, 30, 0, (1960 - (strlen($users[$a]['nationalcode']) * 19)), 2165, $black, $font, $users[$a]['nationalcode']);
                            imagettftext($img, 30, 0, (1960 - (strlen(pdate('Y/m/d', $users[$a]['data']['dateOfBirth'])) * 16)), 2225, $black, $font, pdate('Y/m/d', $users[$a]['data']['dateOfBirth']));
                        }
                        elseif($a == 6)
                        {
                            $id = $users[$a]['memberID'];
                            // The text to draw
                            $nameN = fagd($users[$a]['data']['firstName'] . ' ' . $users[$a]['data']['lastName'],'fa','nastaligh');
                            $fnameN = fagd($users[$a]['data']['fatherName'],'fa','nastaligh');

                            // Add the text
                            imagettftext($img, 30, 0, (890 - (strlen($id) * 19)), 2690, $black, $font, $id);
                            imagettftext($img, 30, 0, (875 - (strlen($users[$a]['data']['firstName'] . ' ' . $users[$a]['data']['lastName']) * 8)), 2735, $black, $font, $nameN);
                            imagettftext($img, 30, 0, (930 - (strlen($users[$a]['data']['fatherName']) * 8)), 2805, $black, $font, $fnameN);
                            imagettftext($img, 30, 0, (930 - (strlen($users[$a]['nationalcode']) * 19)), 2870, $black, $font, $users[$a]['nationalcode']);
                            imagettftext($img, 30, 0, (930 - (strlen(pdate('Y/m/d', $users[$a]['data']['dateOfBirth'])) * 16)), 2930, $black, $font, pdate('Y/m/d', $users[$a]['data']['dateOfBirth']));
                        }
                        elseif($a == 7)
                        {
                            $id = $users[$a]['memberID'];
                            // The text to draw
                            $nameN = fagd($users[$a]['data']['firstName'] . ' ' . $users[$a]['data']['lastName'],'fa','nastaligh');
                            $fnameN = fagd($users[$a]['data']['fatherName'],'fa','nastaligh');

                            // Add the text
                            imagettftext($img, 30, 0, (1920 - (strlen($id) * 19)), 2680, $black, $font, $id);
                            imagettftext($img, 30, 0, (1905 - (strlen($users[$a]['data']['firstName'] . ' ' . $users[$a]['data']['lastName']) * 8)), 2740, $black, $font, $nameN);
                            imagettftext($img, 30, 0, (1960 - (strlen($users[$a]['data']['fatherName']) * 8)), 2800, $black, $font, $fnameN);
                            imagettftext($img, 30, 0, (1960 - (strlen($users[$a]['nationalcode']) * 19)), 2865, $black, $font, $users[$a]['nationalcode']);
                            imagettftext($img, 30, 0, (1960 - (strlen(pdate('Y/m/d', $users[$a]['data']['dateOfBirth'])) * 16)), 2920, $black, $font, pdate('Y/m/d', $users[$a]['data']['dateOfBirth']));
                        }

                    }
                    // Using imagepng() results in clearer text compared with imagejpeg()
                    imagepng($img);
                    imagedestroy($img);
                }

            }
        }
}