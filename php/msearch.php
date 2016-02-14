<?php

    include_once "dbconnect.php"; 



    	$medrecid=$_POST["medrecid"];
		$sql_identification=mysqli_query($sql_link, "SELECT * FROM identifications WHERE medrecid='$medrecid' LIMIT 1");
		$sql_address_primary=("SELECT * FROM addresses WHERE medrecid='$medrecid' AND alternate=false LIMIT 1");
		$sql_address_alternate=("SELECT * FROM addresses WHERE medrecid='$medrecid' AND alternate=true LIMIT 1");
		$sql_icontacts_primary=("SELECT * FROM icontacts WHERE medrecid='$medrecid' AND alternate=false LIMIT 1");
		$sql_icontacts_alternate=("SELECT * FROM icontacts WHERE medrecid='$medrecid' AND alternate=true LIMIT 1");
		$sql_insurance=("SELECT * FROM insurances WHERE medrecid='$medrecid' LIMIT 1");
		$sql_mhoptions=("SELECT * FROM mh_options LEFT JOIN mhistory ON mh_options.id=mhistory.mh_options_id WHERE medrecid='$medrecid'");
		$sql_idiseases=("SELECT * FROM dis_options LEFT JOIN indiseases ON dis_options.id=indiseases.dis_options_id WHERE medrecid='$medrecid'");
		$sql_immunizations=("SELECT * FROM im_options LEFT JOIN immunizations ON im_options.id=immunizations.im_options_id WHERE medrecid='$medrecid'");
		$sql_fmhistory=("SELECT * FROM fmh_options LEFT JOIN fmhistory ON fmh_options.id=fmhistory.fmh_options_id WHERE medrecid='$medrecid'");
		$sql_current_status=mysqli_query($sql_link, "SELECT * FROM currentstatus WHERE medrecid='$medrecid' LIMIT 1");
		$found= mysqli_num_rows($sql_identification);

 		if($found>0){
		    $identification=mysqli_fetch_array($sql_identification);
		    $address_primary=mysqli_fetch_array(mysqli_query($sql_link,$sql_address_primary));
		    $address_alternate=mysqli_fetch_array(mysqli_query($sql_link,$sql_address_alternate));
		    $icontacts_primary=mysqli_fetch_array(mysqli_query($sql_link,$sql_icontacts_primary));
		    $icontacts_alternate=mysqli_fetch_array(mysqli_query($sql_link,$sql_icontacts_alternate));
		    $insurance=mysqli_fetch_array(mysqli_query($sql_link,$sql_insurance));
		    $mh_options=mysqli_query($sql_link,$sql_mhoptions);
		    $i_diseases=mysqli_query($sql_link,$sql_idiseases);
		    $immunizations=mysqli_query($sql_link,$sql_immunizations);
		    $fmhistory=mysqli_query($sql_link,$sql_fmhistory);
		    $current_status=mysqli_fetch_array($sql_current_status);
		        echo " 
		                <div class='tab-content'> 
		                    <ul class='nav nav-tabs'>
		                        <li class='active'><a href='#a' class='tab_link' data-toggle='tab'>A.Identification</a></li>
		                        <li><a href='#b' class='tab_link' data-toggle='tab'>B.Insurance Provider</a></li>
		                        <li><a href='#c' class='tab_link' data-toggle='tab'>C.Medical History</a></li>
		                        <li><a href='#d' class='tab_link' data-toggle='tab'>D.Infectious Diseases</a></li>
		                        <li><a href='#e' class='tab_link' data-toggle='tab'>E.Immunizations</a></li>
		                        <li><a href='#f' class='tab_link' data-toggle='tab'>F.Family Member History</a></li>
		                        <li><a href='#g' class='tab_link' data-toggle='tab'>G.Current Status</a></li>
		                    </ul> 
		                    <div id='a' class='tab-pane active'>
			                    <h3>A.Identification</h3>
			                    <div class='row fixed-table'>
			                        <div class='table-content'>
			                            <table class='table table-striped text-muted well' id='mytable'>
			                                <tbody>
			                                	<tr>
		                                            <td colspan='2' class='text-center'><h3>General Information:</h3></td>
					                            </tr>
			                                    <tr>
			                                        <td>
			                                            Full Name:
			                                        </td>
			                                        <td>
			                                            $identification[fname]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Date of Birth:
			                                        </td>
			                                        <td>
			                                            $identification[dob]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            SEX:
			                                        </td>
			                                        <td>
			                                            $identification[sex]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Blood Type:
			                                        </td>
			                                        <td>
			                                            $identification[btype]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Height:
			                                        </td>
			                                        <td>
			                                            $identification[height]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Weight:
			                                        </td>
			                                        <td>
			                                            $identification[weight]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Occupation:
			                                        </td>
			                                        <td>
			                                            $identification[occupation]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Languages Spoken:
			                                        </td>
			                                        <td>
			                                            $identification[language]
			                                        </td>
			                                    </tr>
			                                    <tr>
		                                            <td colspan='2' class='text-center'><h3>Primary Address:</h3></td>
					                            </tr>
			                                    <tr>
			                                        <td>
			                                            Country:
			                                        </td>
			                                        <td>
			                                            $address_primary[country]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            City:
			                                        </td>
			                                        <td>
			                                            $address_primary[city]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Zip Code:
			                                        </td>
			                                        <td>
			                                            $address_primary[postalcode]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Address:
			                                        </td>
			                                        <td>
			                                            $address_primary[address]
			                                        </td>
			                                    </tr>
			                                    <tr>
		                                            <td colspan='2' class='text-center'><h3>Alternate Address:</h3></td>
					                            </tr>
			                                    <tr>
			                                        <td>
			                                            Country:
			                                        </td>
			                                        <td>
			                                            $address_alternate[country]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            City:
			                                        </td>
			                                        <td>
			                                            $address_alternate[city]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Code:
			                                        </td>
			                                        <td>
			                                            $address_alternate[postalcode]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Address:
			                                        </td>
			                                        <td>
			                                            $address_alternate[address]
			                                        </td>
			                                    </tr>
			                                    <tr>
		                                            <td colspan='2' class='text-center'><h3>Primary Contact Information:</h3></td>
					                            </tr>
			                                    <tr>
			                                        <td>
			                                            Home Phone:
			                                        </td>
			                                        <td>
			                                            $icontacts_primary[hphone]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Work Phone:
			                                        </td>
			                                        <td>
			                                            $icontacts_primary[wphone]
			                                		</td>
			                            		</tr>
			                            		<tr>
			                                		<td>
			                                    		Cell Phone:
			                                		</td>
			                                		<td>
			                                    		$icontacts_primary[cphone]
			                                		</td>
			                            		</tr>
			                            		<tr>
			                                		<td>
			                                    		FAX:
			                                		</td>
			                                		<td>
			                                    		$icontacts_primary[fax]
			                                		</td>
			                            		</tr>
			                            		<tr>
			                                		<td>
			                                    		E-mail:
			                                		</td>
			                                		<td>
			                                    		$icontacts_primary[email]
			                                		</td>
			                            		</tr>
			                            		<tr>
		                                            <td colspan='2' class='text-center'><h3>Alternate Contact Information:</h3></td>
					                            </tr>
			                            		<tr>
			                                		<td>
			                                    		Home Phone:
			                                		</td>
			                                		<td>
			                                    		$icontacts_alternate[hphone]
			                                		</td>
			                            		</tr>
			                            		<tr>
			                                		<td>
			                                    		Work Phone:
			                                		</td>
			                                		<td>
			                                    		$icontacts_alternate[wphone]
			                                		</td>
			                            		</tr>
			                            		<tr>
			                                		<td>
			                                    		Cell Phone:
			                                		</td>
			                                		<td>
			                                   			$icontacts_alternate[cphone]
			                                		</td>
			                            		</tr>
			                            		<tr>
			                                		<td>
			                                   		    FAX:
			                                		</td>
			                                		<td>
			                                    		$icontacts_alternate[fax]
			                               			</td>
			                            		</tr>
			                            		<tr>
			                                		<td>
			                                    		E-mail:
			                                		</td>
			                                		<td>
			                                   		    $icontacts_alternate[email]
			                                		</td>
			                            		</tr>
			                        		</tbody>
			                    		</table>
			                    	</div>	  
			                    </div>
		                    </div>   
		                    <div id='b' class='tab-pane'> 
		                        <h3>B.Insurance Provider</h3>
			                    <div class='row fixed-table'>
			                        <div class='table-content'>
			                            <table class='table table-striped text-muted well' id='mytable'>
			                                <tbody>
			                                    <tr>
			                                        <td>
			                                            Insurance Provider Type:
			                                        </td>
			                                        <td>
			                                            $insurance[iptype]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Company Name:
			                                        </td>
			                                        <td>
			                                            $insurance[ipcname]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Address: 
			                                        </td>
			                                        <td>
			                                            $insurance[ipaddress]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            City:
			                                        </td>
			                                        <td>
			                                            $insurance[ipcity]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Zip Code:
			                                        </td>
			                                        <td>
			                                            $insurance[ipzcode]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Country: 
			                                        </td>
			                                        <td>
			                                            $insurance[ipcountry]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Phone: 
			                                        </td>
			                                        <td>
			                                            $insurance[ipphone]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            E-mail Address: 
			                                        </td>
			                                        <td>
			                                            $insurance[ipemail]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Fax:
			                                        </td>
			                                        <td>
			                                            $insurance[ipfax]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Web Address:
			                                        </td>
			                                        <td>
			                                            $insurance[ipwaddress]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Member(ID) Number:
			                                        </td>
			                                        <td>
			                                            $insurance[ipmnumber]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Social Security No.:
			                                        </td>
			                                        <td>
			                                            $insurance[ipssnumber]
			                                        </td>
			                                    </tr>
			                                </tbody>
			                            </table>
			                        </div>    
			                    </div>                
		                    </div>
		                    <div id='c' class='tab-pane'> 
		                        <h3>C.Medical History</h3>
		                        <div class='row fixed-table'>
		                            <div class='table-content'>
		                                <table class='table table-striped text-muted well' id='mytable'>
		                                    <thead>
		                                        <tr>
		                                            <th>Disease</th>
		                                            <th>Date On Set</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>";
		                                        while($row = mysqli_fetch_array($mh_options)){
		                                        	echo "<tr class='text-center'>
			                                        	<td>
			                                            	$row[name] 
			                                        	</td>
			                                        	<td>
			                                            	$row[donset]
			                                        	</td>
			                                    	</tr>";
		                                        }
		                                   echo "</tbody>
		                                </table>
		                            </div>
		                        </div>
		                    </div>
		                    <div id='d' class='tab-pane'>
		                        <h3>D.Infectious Diseases</h3>
		                        <div class='row fixed-table'>
		                            <div class='table-content'>
		                                <table class='table table-striped text-muted well' id='mytable'>
		                                    <thead>
		                                        <tr>
		                                            <th>Disease</th>
		                                            <th>Age</th>
		                                            <th>Date</th>
		                                            <th>Remarks</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>";
		                                        while($row = mysqli_fetch_assoc($i_diseases)){
		                                        	echo "<tr class='text-center'>
		                                        	    <td>
		                                        	        $row[name]
		                                        	    </td>
			                                        	<td>
			                                            	$row[age] 
			                                        	</td>
			                                        	<td>
			                                            	$row[indate]
			                                        	</td>
			                                        	<td>
			                                            	$row[remarks]
			                                        	</td>
			                                    	</tr>";
		                                        }
		                                   echo "</tbody>
		                                </table>
		                            </div>
		                        </div>
		                    </div>
		                    <div id='e' class='tab-pane'>
		                        <h3>E.Immunizations</h3>
		                        <div class='row fixed-table'>
		                            <div class='table-content'>
		                                <table class='table table-striped table-fixed-header text-muted well' id='mytable'>
		                                    <thead>
		                                       <tr>
		                                             <th></th>
		                                             <th colspan=2 class='text-center'>Booster 1</th>
		                                             <th colspan=2 class='text-center'>Booster 2</th>
		                                             <th colspan=2 class='text-center'>Booster 3</th>
		                                        </tr>
		                                        <tr>
		                                            <th class='text-center'>Immunization for</th>
		                                            <th class='text-center'>Age</th>
		                                            <th class='text-center'>Date</th>
		                                            <th class='text-center'>Age</th>
		                                            <th class='text-center'>Date</th>
		                                            <th class='text-center'>Age</th>
		                                            <th class='text-center'>Date</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody >";
		                                        while($row = mysqli_fetch_assoc($immunizations)){
		                                        	echo "<tr class='text-center'>
		                                        	    <td>
		                                        	        $row[name]
		                                        	    </td>
			                                        	<td>
			                                            	$row[agea] 
			                                        	</td>
			                                        	<td>
			                                            	$row[datea]
			                                        	</td>
			                                        	<td>
			                                            	$row[ageb]
			                                        	</td>
			                                        	<td>
			                                            	$row[dateb]
			                                        	</td>
			                                        	<td>
			                                            	$row[agec]
			                                        	</td>
			                                        	<td>
			                                            	$row[datec]
			                                        	</td>
			                                    	</tr>";
		                                        }
		                                   echo "</tbody>
		                                </table>
		                            </div>
		                        </div>
		                    </div>
		                    <div id='f' class='tab-pane'>
		                        <h3>D.Infectious Diseases</h3>
		                        <div class='row fixed-table'>
		                            <div class='table-content'>
		                                <table class='table table-striped table-fixed-header text-muted well' id='mytable'>
		                                    <thead>
		                                        <tr>
		                                            <th></th>
		                                            <th>Mother</th>
		                                            <th>Father</th>
		                                            <th>Sibling(s)</th>
		                                            <th>Grandparent(s)</th>
		                                            <th>Children</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>";
		                                        while($row = mysqli_fetch_assoc($fmhistory)){
		                                        	echo "<tr class='text-center'>
		                                        	    <td>
		                                        	        $row[name]
		                                        	    </td>
		                                        	    <td>
		                                        	        $row[mother]
		                                        	    </td>
			                                        	<td>
			                                            	$row[father] 
			                                        	</td>
			                                        	<td>
			                                            	$row[siblings]
			                                        	</td>
			                                        	<td>
			                                            	$row[grandparents]
			                                        	</td>
			                                        	<td>
			                                            	$row[children]
			                                        	</td>
			                                    	</tr>";
		                                        }
		                                   echo "</tbody>
		                                </table>
		                            </div>
		                        </div>
		                    </div>
		                    <div id='g' class='tab-pane'>
			                    <h3>A.Identification</h3>
			                    <div class='row fixed-table'>
			                        <div class='table-content'>
			                            <table class='table table-striped text-muted well' id='current_status'>
			                                <tbody>
			                                	<tr>
		                                            <td colspan='2' class='text-center'><h3>Current Status:</h3></td>
					                            </tr>
			                                    <tr>
			                                        <td>
			                                            Diagnosis:
			                                        </td>
			                                        <td>
			                                            $current_status[diagnosis]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Medical Treatment:
			                                        </td>
			                                        <td>
			                                            $current_status[m_treatment]
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                        <td>
			                                            Medical Treatment(start-end):
			                                        </td>
			                                        <td>
			                                            $current_status[start] To  $current_status[end]
			                                        </td>
			                                    </tr>
			                        		</tbody>
			                    		</table>
			                    	</div>	  
			                    </div>
		                    </div>   
		                </div>    
		            ";   
		 }else{
		    echo "Wrong Medrec ID";
		 }
?>