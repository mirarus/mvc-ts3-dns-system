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
<?php require VMDIR.'/Template/header.php'; ?>
<div class="row">
	<div class="col-12 grid-margin">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title"><?php echo "#".$Support_Data['id'].' Destek Talebi Görüntüle - '.$Support_Data['title']; ?> <?php echo $Support_Data['status'] == '4' ? '   - <font style="color:#fe7c96">Kapalı</font>' : ''; ?></h4>
				<div class="mt-4">
					<?php foreach ($Support_Replies_Data_F as $Support_Replies_Data_R) { ?>
						<?php $User_Data = controller::model('user')->GetUserByID($Support_Replies_Data_R['u_id']); ?>
						<?php $Admin_Data = controller::model('admin')->GetAdminByID($Support_Replies_Data_R['u_id']); ?>
						<div class="form-group" style="border:0.1px solid #ddd;padding: 15px">
							<label style="margin-bottom: 20px">
								<?php
								echo $Support_Replies_Data_R['admin'] == 1 ? '<strong>'.$Admin_Data['username'] : '<strong>'.$User_Data['mail'] ;
								if($Support_Replies_Data_R['admin'] == 1) {echo ' <font style="color:#fe7c96">(</font><font style="color:#57c7d4">Yetkili</font><font style="color:#fe7c96">)</font>';} else{echo ' <font style="color:#fe7c96">(</font><font style="color:#1bcfb4">Siz</font><font style="color:#fe7c96">)</font>';}
								echo '</strong> - <strong>'.date('d.m.Y H:i:s', $Support_Replies_Data_R['time']).'</strong>';
								?>
							</label>
							<div class="alert alert-secondary" style="background:#f7f8fa;color:#343a40;padding:.85rem 1.5rem;border-radius:4px;position:relative;margin-bottom:1rem;border:1px solid transparent;">
								<?php echo '<strong>'.$Support_Replies_Data_R['content'].'</strong>'; ?>
							</div>
							<?php if ($Support_Replies_Data_R['admin'] != 1) {
								echo '<hr><strong>İp Adresi: '.$User_Data['login_ip'].' | Mail: '.$User_Data['mail'].' | Üye İd: '.$User_Data['id'].'</strong>';
							} ?>
						</div>
						<?php 
					}
					?>
					<hr class="row" width="104%">
					<div id="SupportMessageSendAlert" class="mt-3"></div>
					<form class="forms-sample" action="" onsubmit="return false;">
						<div class="form-group">
							<label for="content">Mesaj</label>
							<textarea class="form-control" id="content" rows="6"></textarea>
						</div>
						<button onclick="SupportMessageSend(<?php echo $Support_Data['id']; ?>);" id="SupportMessageSendBtn" type="submit" style="margin-left: 36%" class="btn btn-gradient-success mr-2">Gönder</button>
						<button onclick="SupportAlertHide();" type="reset" class="btn btn-gradient-danger">İptal</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require VMDIR.'/Template/footer.php'; ?>