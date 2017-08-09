
<section id="users">

    <h2>Manage Users</h2>

    <div id="user-actions"><a href="/user/registration" id="add-user" class="add"><i></i>Add User</a></div>

    <div id="user-search">
        <h3>Search for User</h3>
        <div id="user-search-name">
            <form action="/manage-users" method="POST">
<?php if(isset($_POST["search-name"]) && $_POST["search-name"]!=""):?>
                <input type="text" name="search-name" id="search-name" value="<?php echo($_POST["search-name"]);?>"/>
<?php else:?>
                <input type="text" name="search-name" id="search-name" placeholder="Name"/>
<?php endif;?>
                <input type="submit" value="Search"/>
            </form>
        </div>
        <div id="user-search-filter">
            <form action="/manage-users" method="POST">
                <label for="filter-by-role">Filter by:</label>
                <select name="filter-by-role" id="filter-by-role">
                    <option value="">All</option>
<?php $roles = user_roles();
foreach( $roles as $rid => $role ){
    if( $rid > 2 ){
        if( isset($_POST["filter-by-role"]) && $role==$_POST["filter-by-role"] ):?>
                    <option selected="selected" value="<?php echo($role);?>"><?php echo($role);?></option>
<?php else:?>
                    <option value="<?php echo($role);?>"><?php echo($role);?></option>
<?php endif;
    }
}?>
                </select>
                <div>
<?php if( isset($_POST["filter-by"]) && $_POST["filter-by"]!="all" ):?>
                    <input type="radio" name="filter-by" value="all" id="filter-by-all"/><label for="filter-by-all">All Users</label>
<?php if( $_POST["filter-by"]=="active" ):?>
                    <input type="radio" name="filter-by" value="active" id="filter-by-active" checked="checked"/><label for="filter-by-active">Active Users</label>
                    <input type="radio" name="filter-by" value="inactive" id="filter-by-inactive"/><label for="filter-by-inactive">Inactive Users</label>
<?php elseif( $_POST["filter-by"]=="inactive" ):?>
                    <input type="radio" name="filter-by" value="active" id="filter-by-active"/><label for="filter-by-active">Active Users</label>
                    <input type="radio" name="filter-by" value="inactive" id="filter-by-inactive" checked="checked"/><label for="filter-by-inactive">Inactive Users</label>
<?php endif;?>
<?php else:?>
                    <input type="radio" name="filter-by" value="all" id="filter-by-all" checked="checked"/><label for="filter-by-all">All Users</label>
                    <input type="radio" name="filter-by" value="active" id="filter-by-active"/><label for="filter-by-active">Active Users</label>
                    <input type="radio" name="filter-by" value="inactive" id="filter-by-inactive"/><label for="filter-by-inactive">Inactive Users</label>
<?php endif;?>
                </div>
            </form>
        </div>
    </div><!--end #user-search-->

    <div class="heading">
        <span class="name"><a href="/manage-users?sortby=name"<?php if(isset($_GET["sortby"]) && $_GET["sortby"]=="name") echo(" class=\"active\"");?>>Name</a></span>
        <!--span class="region"><a href="/manage-users?sortby=region"
<?php if(isset($_GET["sortby"]) && $_GET["sortby"]=="region") echo(" class=\"active\"");?>>Region</a></span-->
    </div>



    <div id="users-list">
        <ul>
<?php
for($x=$startItem; $x<$endItem; $x++){?>
            <li>
                <a href="/user/<?php echo($users[$x]->uid);?>">
                    <span class="name"><?php echo($users[$x]->uid);?>. <?php echo($users[$x]->field_first_name[LANGUAGE_NONE][0]["value"]." ".$users[$x]->field_last_name[LANGUAGE_NONE][0]["value"]);?></span>
                    <!--span class="region"><?php #echo(covidien_users_get_region_from_zipcode($users[$x]->field_primary_location_zip[LANGUAGE_NONE][0]["value"]));?></span-->
                </a>
                <div class="user-actions">
                    <a href="/deactivate/<?php echo($users[$x]->uid);?>" class="user-actions-deactivate">Deactivate User<i></i></a>
                    <a href="/user/<?php echo($users[$x]->uid);?>/edit" class="user-actions-edit-profile">Edit User Profile<i></i></a>
                </div>
            </li>
<?php }?>
        </ul>
    </div>



</section>

<?php echo(theme('pagination',array('item_count'=>count($users),'page'=>$pagination_page,'perpage'=>$perpage))); ?>
