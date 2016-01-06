<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="page-title change_password_title">
			Member Details <?php echo $this->Html->link('Back',array('action'=>'list'),array('class'=>"back_btn",'escape'=>false));

	 ?>
		</td>
	</tr>
	<tr><td height="10px"> </td></tr>
	<tr>
		<td align="center">
			<table width="100%" cellpadding="0" cellspacing="0" border="0" class="detail_section">
			<tr>
				<td align="left" valign="top">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td align="left" valign="top" colspan="3"><strong>Personal Details</strong></td>
						</tr>
						<tr>
							<td width="25%" align="left" valign="top">Name</td>
							<td width="5%" align="middle" valign="top">:</td>
							<td width="70%" align="left" valign="top"><?php echo $data['User']['name'];?></td>
						</tr>
						<tr>
							<td align="left" valign="top">Email Address</td>
							<td align="middle" valign="top">:</td>
							<td align="left" valign="top"><?php echo $data['User']['email'];?></td>
						</tr>
						<tr>
							<td align="left" valign="top">Address</td>
							<td align="middle" valign="top">:</td>
							<td align="left" valign="top"><?php echo $data['User']['address'];?></td>
						</tr>
						<tr>
							<td align="left" valign="top">Phone</td>
							<td align="middle" valign="top">:</td>
							<td align="left" valign="top"><?php echo $data['User']['phone'];?></td>
						</tr>
						<tr>
							<td align="left" valign="top">Mobile</td>
							<td align="middle" valign="top">:</td>
							<td align="left" valign="top"><?php echo $data['User']['mobile'];?></td>
						</tr>
					</table>
				
				</td>
				<td align="left" valign="top">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td align="left" valign="top" colspan="2"><strong>RegoRenewals Account</strong></td>
						</tr>
						<tr>
							<td width="45%" align="left" valign="top">Type of Inspections</td>
							<td width="5%" align="left" valign="top">:</td>
							<td width="50%" align="left" valign="top"><?php echo str_replace(',', ', ',$data['UserRegoacDetail']['inspect_type']);?></td>
						</tr>
						<tr>
							<td align="left" valign="top">Subscription Type</td>
							<td align="left" valign="top">:</td>
							<td><?php echo $data['UserRegoacDetail']['acc_type'];?></td>
						</tr>
						<tr>
							<td align="left" valign="top">Subscription Fees</td>
							<td align="left" valign="top">:</td>
							<td><?php echo '$'.$data['UserRegoacDetail']['subs_amount'];?></td>
						</tr>
						<tr>
							<td align="left" valign="top">Subscription Expired On</td>
							<td align="left" valign="top">:</td>
							<td><?php $date_time=$data['UserRegoacDetail']['ac_expiry_date']>0?$data['UserRegoacDetail']['ac_expiry_date']:'';echo $this->Time->format('d/m/Y', $date_time);?></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">&nbsp;</td>
				<td align="left" valign="top">&nbsp;</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td align="left" valign="top" colspan="3"><strong>Business Details</strong>
			</td>
						</tr>
						<tr>
							<td width="25%" align="left" valign="top">Business Name</td>
							<td width="5%" align="middle" valign="top">:</td>
							<td width="70%" align="left" valign="top"><?php echo $data['UserBusinessDetail']['name'];?></td>
						</tr>
						<tr>
							<td align="left" valign="top">Address</td>
							<td align="middle" valign="top">:</td>
							<td align="left" valign="top"><?php echo $data['UserBusinessDetail']['address'];?></td>
						</tr>
						<tr>
							<td align="left" valign="top">Postcode</td>
							<td align="middle" valign="top">:</td>
							<td align="left" valign="top"><?php echo $this->Common->getPostcode($data['User']['postcode_id']);?></td>
						</tr>
						<tr>
							<td align="left" valign="top">Suburb</td>
							<td align="middle" valign="top">:</td>
							<td align="left" valign="top"><?php echo $this->Common->getSuburb($data['User']['suburb_id']);?></td>
						</tr>
						<tr>
							<td align="left" valign="top">Phone</td>
							<td align="middle" valign="top">:</td>
							<td align="left" valign="top"><?php echo $data['UserBusinessDetail']['phone'];?></td>
						</tr>
						<tr>
							<td align="left" valign="top">Licence No.</td>
							<td align="middle" valign="top">:</td>
							<td align="left" valign="top"><?php echo $this->Common->getPostcode($data['UserBusinessDetail']['licence_no']);?></td>
						</tr>
						<tr>
							<td align="left" valign="top">ABN/ACN</td>
							<td align="middle" valign="top">:</td>
							<td align="left" valign="top"><?php echo $this->Common->getSuburb($data['UserBusinessDetail']['abn']);?></td>
						</tr>
						<tr>
							<td align="left" valign="top">AIS Number</td>
							<td align="middle" valign="top">:</td>
							<td align="left" valign="top"><?php echo $data['UserBusinessDetail']['ais_no'];?></td>
						</tr>
					</table>
				
				</td>
				<td align="left" valign="top">
				<?php if (file_exists(WWW_ROOT . 'uploads/'.$data['UserBusinessDetail']['logo']) && $data['UserBusinessDetail']['logo']!='') { 
		                    ?>
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td align="left" valign="top" colspan="2"><strong>Logo</strong></td>
						</tr>
						<tr>
							<td align="left" valign="top" rowspan="6" colspan="2">

							
							<img border="0" width="200" src="<?php echo WWW_BASE.'uploads/'.$data['UserBusinessDetail']['logo'];?>" />
		                   
							</td>
							<!--<td align="left" valign="top"></td>-->
						</tr>
					</table>
					<?php } ?>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">&nbsp;</td>
				<td align="left" valign="top">&nbsp;</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td align="left" valign="top" colspan="3"><strong>Bank Details</strong></td>
						</tr>
						<tr>
							<td width="25%" align="left" valign="top">Account Name</td>
							<td width="5%" align="middle" valign="top">:</td>
							<td width="70%" align="left" valign="top"><?php echo $data['UserBankDetail']['ac_name'];?></td>
						</tr>
						<tr>
							<td align="left" valign="top">Account Number</td>
							<td align="middle" valign="top">:</td>
							<td align="left" valign="top"><?php echo $data['UserBankDetail']['ac_num'];?></td>
						</tr>
						<tr>
							<td align="left" valign="top">BSB</td>
							<td align="middle" valign="top">:</td>
							<td align="left" valign="top"><?php echo $data['UserBankDetail']['bsb'];?></td>
						</tr>
						<tr>
							<td align="left" valign="top">Bank</td>
							<td align="middle" valign="top">:</td>
							<td align="left" valign="top"><?php echo $data['UserBankDetail']['bank'];?></td>
						</tr>
					</table>
				
				</td>
				<td align="left" valign="top">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td align="left" valign="top" colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td align="left" valign="top"></td>
							<td align="left" valign="top"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">&nbsp;</td>
				<td align="left" valign="top">&nbsp;</td>
			</tr>
			</table>
	   </td>
	</tr>
</table>