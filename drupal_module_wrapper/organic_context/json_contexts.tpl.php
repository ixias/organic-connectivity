<?php header('Content-type: application/json'); ?>
[<?php foreach($contexts as $nid=>$context){ ?>{
"adjacencies": [
<?php if($nid==517): ?>   "graphnode<?php echo($nid); ?>",<?php endif; ?>
<?php if(isset($context->children)): ?>
<?php foreach($context->children as $nid_child=>$context_child){ ?>
<?php #if(isset($contexts[$nid_child]->children)): ?>
{
   "nodeTo": "graphnode<?php echo($nid_child); ?>",
   "nodeFrom": "graphnode<?php echo($nid); ?>",
   "data": {
    "$color": "#557EAA"
   }
},
<?php #endif; ?>
<?php } ?>
<?php endif; ?>
],
"data": {
  "$color": "#c74243",
  "$type": "star",
  "$dim": 8
},
"id": "graphnode<?php echo($nid); ?>",
"name": "<?php echo($context->title); ?>"
      },<?php } ?>]