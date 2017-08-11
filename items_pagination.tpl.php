<?php $pages=ceil($item_count/$perpage); ?>
<?php if($pages>1){ ?>

    <!--div><?php echo($item_count.' <span>Items</span>'); ?></div>
    <div><?php echo($perpage.' <span>Per page</span>'); ?></div>
    <div><?php echo(ceil($item_count/$perpage).' <span>Pages</span>'); ?></div-->

<ul class="pagination">


<?php if($page>1): ?>

                    <!--&amp;perpage=<?php echo($perpage); ?>-->

    <li><a href="?page=<?php echo($page-1); ?>" class="previous">Previous</a></li>
<?php endif; ?>


<?php for($i=1;$i<=$pages;$i++){ ?>

<?php if( $i == $page): ?>
    <li class="active">
<?php else: ?>
    <li>
<?php endif; ?>

                    <!--&amp;perpage=<?php echo($perpage); ?>-->

        <a href="?page=<?php echo($i); ?>"><?php echo($i); ?></a>
    </li>

<?php } ?>


<?php if($page<$pages): ?>
    <li><a href="?page=<?php echo($page+1); ?>" class="next">Next</a></li>
<?php endif; ?>


</ul>

<?php } ?>
<?php
/*

/////////////////////////////////////////////////////////////////////////////INTEGRATE//////////////////////////

function covidien_pagination( $pages, $page, $perpage ){
    if( $pages>1 ){
        $pagination = '<ul class="pagination">\n';
        if( $page > 1 )
            $pagination .= ' <li class="previous"><a href="?page='.($page-1).'&amp;perpage='.$perpage.'"><span><i></i></span>Prev</a></li>\n';
        for( $i=1; $i<=$pages; $i++ ){
            if( $i == $page ) $pagination .= ' <li class="active">';
            else $pagination .= ' <li>';
            $pagination .= '<a href="?page='.$i.'&amp;perpage='.$perpage.'">'.$i.'</a>';
            $pagination .= '</li>\n';
        }
        if( $page < $pages )
            $pagination .= ' <li class="next"><a href="?page='.($page+1).'">Next<span><i></i></span></a></li>\n';
        $pagination .= '</ul>\n\n';
        return $pagination;
    }
}
*/
?>