<table>
<?

global $user;

foreach( $bahh as $bah ){

	echo( "<tr>\n" );

	if($chil_count) echo( "<td class=\"forums_newposts_column\"><span class=\"new_posts\">New Posts</span></td>\n" );
	else echo( "<td class=\"forums_newposts_column\"><span class=\"no_new_posts\">No New Posts</span></td>\n" );

	echo( "<td class=\"forums_title_column\"><a href=\"/node/".$bah->nid."\">".$bah->title."</a>".$row["node_revisions_body"]."</td>\n");

	echo( "<td class=\"forums_stats_column\">".( $chil_comment_count + $chil_count )." Posts<br/>" . $chil_count . " Topics</td>\n" );

	echo("<td class=\"forums_lastpost_column\">\n");
if( array_search("authenticated user",$user->roles)){
echo("	<a href=\"/node/add/forum-post?edit[field_education_type][nid][nid]=".$row["nid"]."&edit[field_forum][nid][nid]=".$row_chillinz["nid"]."\" class=\"cms\">+ Topic</a>\n");
}
	if($last_post) echo( "<div>Last post by <a href=\"/user/". $last_post["node_comment_statistics_last_comment_uid"]."\">". $last_post["node_comment_statistics_last_comment_name"]."</a></div><div>in <a href=\"/node/".$last_post["nid"]."\">".$last_post["node_title"]."</a></div><div>on ".date("F j, Y",$last_post["node_comment_statistics_last_comment_timestamp"])."</div>\n" );
		//print_r($last_post);
	echo("</td>\n");



	echo( "</tr>\n" );

}
?>
</table>