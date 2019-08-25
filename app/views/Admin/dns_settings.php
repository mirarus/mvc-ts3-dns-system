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
<?php require VADIR.'/Template/header.php'; ?>
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">DNS Ayarlarını Düzenle</h4>
                <p class="card-description"> Aşağıdaki Bölgelere Bilgilerinizi Girerek Kolayca DNS Ayarlarını Düzenleyebilirsiniz. </p>
                <div id="DNSSettingsEditAlert"></div>
                <form class="forms-sample mt-5" action="" onsubmit="return false;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mail">CLOUDFLARE Mail <font color="red">*</font></label>
                                <input type="text" class="form-control" id="mail" placeholder="Site Başlık Giriniz." value="<?php echo $DNS_Control['mail']; ?>">
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="apikey">CLOUDFLARE ApiKey <font color="red">*</font></label>
                                <input type="text" class="form-control" id="apikey" placeholder="Site Açıklaması Giriniz." value="<?php echo $DNS_Control['apikey']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="domain">DNS Domainleri - Her Domain Arasına "|" Koyun <font color="red">*</font></label>
                        <textarea rows="6" class="form-control" id="domain" placeholder="Site Alt Bilgi Giriniz."><?php echo $DNS_Control['domain']; ?></textarea>
                    </div>
                    <button onclick="DNSSettingsEdit(<?php echo $DNS_Control['id']; ?>);" id="DNSSettingsEditBtn" type="submit" style="margin-left: 36%" class="btn btn-gradient-success mr-2">Düzenle</button>
                    <button onclick="DNSSettingsAlertHide();" type="reset" class="btn btn-gradient-danger">İptal</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require VADIR.'/Template/footer.php'; ?>