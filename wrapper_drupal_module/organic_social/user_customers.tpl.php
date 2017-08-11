
<section id="customers">

    <h2><input type="text" name="" id="" placeholder="Find Customer"/>My Customers</h2>

    <div id="doctors_nav">
        <div id="user-location-filter">
            View by:
            <form action="/customers" method="POST">
                <input type="radio" name="filter-location" id="filter-location-office" value="office"<?php if(isset($_POST['filter-location']) && $_POST['filter-location']=='office'):?> checked="checked"<?php endif;?>/>
                <label for="filter-location-office">Office</label>
                <input type="radio" name="filter-location" id="filter-location-hospital" value="hospital"<?php if(isset($_POST['filter-location']) && $_POST['filter-location']=='hospital'):?> checked="checked"<?php endif;?>/>
                <label for="filter-location-hospital">Hospital</label>
            </form>
        </div>
        <div class="submenu">
            <span>Sort by</span>
            <ul>
                <li><a href="/customers?sortby=name">Name</a></li>
                <li><a href="/customers?sortby=creation">Signup Date</a></li>
            </ul>
        </div>
        <div class="submenu">
            <span>Filter by</span>
            <ul>
                <li><a href="/customers?filterby=pad">PAD</a></li>
                <li><a href="/customers?filterby=cvi">CVI</a></li>
                <li><a href="/customers?filterby=pad_cvi">PAD+CVI</a></li>
            </ul>
        </div>
        <div><a href="/user/registration" id="add-user" class="add"><i></i>Add Customer</a></div>
    </div>

    <div id="user-actions"></div>

    <ul>
<?php for($x=0; $x<$endItem; $x++){?>
        <li>
            <div class="doctor-intro">
                <a href="/user/<?php echo($users[$x]->uid);?>" class="profile-photo">
                    <img src="<?php if(!empty($users[$x]->field_photo[LANGUAGE_NONE])) echo(image_style_url('customer_face',$users[$x]->field_photo[LANGUAGE_NONE][0]['uri']));?>" alt="Profile Image"/>
                </a>
                <div class="doctor-intro-main">
                    <a href="/deactivate/<?php echo($users[$x]->uid);?>" class="deactivation-link">Deactivate</a>
                    <?php if(!empty($acct->field_medical_procedures)):?><div class="procedure"><?php echo($users[$x]->field_medical_procedures[LANGUAGE_NONE][0]['value']);?></div><?php endif;?>
                    <h3><?php echo($users[$x]->field_first_name[LANGUAGE_NONE][0]['value'].' '.$users[$x]->field_last_name[LANGUAGE_NONE][0]['value']);?></h3>
                    <?php echo($users[$x]->address);?>
                    <a href="http://maps.google.com/?q=<?php echo($users[$x]->address);?>" class="map-link">View Map</a>
                    <div>
                        <?php if(!empty($users[$x]->field_primary_location_phone[LANGUAGE_NONE])):?>Office: <?php echo($users[$x]->field_primary_location_phone[LANGUAGE_NONE][0]['value']);?><?php endif;?>
                        <?php if(!empty($acct->field_mobile_phone[LANGUAGE_NONE])):?>Mobile: <?php echo($users[$x]->field_mobile_phone[LANGUAGE_NONE][0]['value']);?><?php endif;?>
                    </div>
                </div><!--end .doctor-intro-main-->
            </div><!--end .doctor-intro-->
            <div>
                <a href="/user/<?php echo($users[$x]->uid);?>/edit" class="go">Edit Profile</a>
                <a href="/node/add/message?to=<?php echo($users[$x]->uid);?>" class="go">Send Message</a>
                <a href="#" class="go">Portal View</a>
            </div>
            <div class="doctor-viewers">
                <a href="/customers?analytics=<?php echo($users[$x]->uid);?>"><i></i>Analytics</a>
<?php echo(theme('customer_files',array('uid'=>$users[$x]->uid)));?>
            </div>
        </li>
<?php }?>
    </ul>

</section>

<?php echo(covidien_pagination($pages, $pagination_page, $perpage));?>
