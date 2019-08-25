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
?>
<?php
/**
 * Unreal Studio
 * Project: UnrealLicensing
 * User: jhollsoliver
 * Date: 03/06/15
 * Time: 19:01
 */

class Gauntlet {

    public static function filter($texto){
        // Lista de palavras para procurar
        $check[1] = chr(34); // símbolo "
        $check[2] = chr(39); // símbolo '
        $check[3] = chr(92); // símbolo /
        $check[4] = chr(96); // símbolo `
        $check[5] = "drop table";
        $check[6] = "update";
        $check[7] = "alter table";
        $check[8] = "drop database";
        $check[9] = "drop";
        $check[10] = "select";
        $check[11] = "delete";
        $check[12] = "insert";
        $check[13] = "alter";
        $check[14] = "destroy";
        $check[15] = "table";
        $check[16] = "database";
        $check[17] = "union";
        $check[18] = "TABLE_NAME";
        $check[19] = "1=1";
        $check[20] = 'or 1';
        $check[21] = 'exec';
        $check[22] = 'INFORMATION_SCHEMA';
        $check[23] = 'like';
        $check[24] = 'COLUMNS';
        $check[25] = 'into';
        $check[26] = 'VALUES';
        $check[27] = 'kill';
        $check[28] = 'union';
        $check[29] = '$';
        // Cria se as variáveis $y e $x para controle no WHILE que fará a busca e substituição
        $y = 1;
        $x = sizeof($check);
        // Faz-se o WHILE, procurando alguma das palavras especificadas acima, caso encontre alguma delas, este script substituirá por um espaço em branco " ".
        while($y <= $x){
            $target = strpos($texto,$check[$y]);
            if($target !== false){
                $texto = str_replace($check[$y], "", $texto);
            }
            $y++;
        }
        // Retorna a variável limpa sem perigos de SQL Injection
        return $texto;
    }

}