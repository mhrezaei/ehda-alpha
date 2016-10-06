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
                imagettftext($img, 25, 0, (600 - (strlen($id) * 19)), 612, $black, $font, $id);
                imagettftext($img, 25, 0, (600 - (strlen($user['data']['firstName'] . ' ' . $user['data']['lastName']) * 8)), 670, $black, $font, $nameN);
                imagettftext($img, 25, 0, (600 - (strlen($user['data']['fatherName']) * 9)), 706, $black, $font, $fnameN);
                imagettftext($img, 25, 0, (600 - (strlen($user['data']['identifier']) * 19)), 747, $black, $font, $user['data']['identifier']);
                imagettftext($img, 25, 0, (600 - (strlen(pdate('Y/m/d', $user['data']['dateOfBirth'])) * 17)), 782, $black, $font, pdate('Y/m/d', $user['data']['dateOfBirth']));

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
                imagettftext($img, 30, 0, (950 - (strlen($id) * 19)), 457, $black, $font, $id);
                imagettftext($img, 30, 0, (950 - (strlen($user['data']['firstName'] . ' ' . $user['data']['lastName']) * 8)), 530, $black, $font, $nameN);
                imagettftext($img, 30, 0, (950 - (strlen($user['data']['fatherName']) * 8)), 572, $black, $font, $fnameN);
                imagettftext($img, 30, 0, (950 - (strlen($user['data']['identifier']) * 19)), 619, $black, $font, $user['data']['identifier']);
                imagettftext($img, 30, 0, (950 - (strlen(pdate('Y/m/d', $user['data']['dateOfBirth'])) * 16)), 659, $black, $font, pdate('Y/m/d', $user['data']['dateOfBirth']));
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
}