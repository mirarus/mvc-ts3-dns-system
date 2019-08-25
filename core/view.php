<?php
/*
    Mirarus MVC Dns System for everyone
    Copyright (C) 2019 by Mirarus

    This program is free software
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
        
    for help look https://mirarus.com/mvc-ts3-dns-system
*/
    
class view
{
    public static function Mainrender($view, array $params = [])
    {
        if (file_exists($file = VDIR."/Main/{$view}.php")) {
            extract($params);
            ob_start();
            require $file;
            echo ob_get_clean();
        } else{
            exit("Görünüm dosyası bulunamadı: $view");
        }
    }

    public static function Adminrender($view, array $params = [])
    {
        if (file_exists($file = VDIR."/Admin/{$view}.php")) {
            extract($params);
            ob_start();
            require $file;
            echo ob_get_clean();
        } else{
            exit("Görünüm dosyası bulunamadı: $view");
        }
    }
}

?>