jQuery(function($){




    if($('svg#d3_force').length){


        var width=$('svg#d3_force').width(),
            height=$('svg#d3_force').height();

        var svg1=d3.select('svg#d3_force')
            .attr('width',width)
            .attr('height',height);

        var color=d3.scaleOrdinal(d3.schemeCategory10);

        var simulation=d3.forceSimulation()
            .force('link',d3.forceLink().id(function(d){return d.id;}).distance(150).strength(1))
            .force('charge',d3.forceManyBody())
            .force('center',d3.forceCenter(width/2,height/2));

        d3.json('/connectivity/feeds/json_ForceDirected_d3',function(error,graph){

            if (error) throw error;

            var link=svg1.append('g')
                         .attr('class','links')
                         .selectAll('.link')
                         .data(graph.links)
                        .enter().append('line')
                        .attr('class','link')
                        .attr('stroke-width', function(d) { return Math.sqrt(d.value); });

            var node=svg1.append('g')
                         .attr('class','nodes')
                         .selectAll('.node')
                        .data(graph.nodes)
                  .enter().append('g')
                  .attr('class','node')
                  .attr('id',function(d){return('organelle_'+d.id);})
                  .call(d3.drag()
                      .on('start',dragstarted)
                      .on('drag',dragged)
                      .on('end',dragended));

          node.append('circle')
              .attr('r',function(d){
                if(d.group==0) return '20px';
                else if(d.group==1) return '18px';
                else if(d.group==2) return '16px';
                else if(d.group==3) return '13px';
                else if(d.group==4) return '11px';
                else return '9px';
              })
              .style('fill',function(d) { return color(d.group); });

/*          node.append('image')
              .attr('xlink:href','https://github.com/favicon.ico')
              .attr('x', -8)
              .attr('y', -8)
              .attr('width', 16)
              .attr('height', 16);

  node.append('title')
      .text(function(d) { return d.id; });*/

          node.append('title')
              .text(function(d) { return d.name; });

          node.append('text')
              .attr('dx',15)
              .attr('dy',7)
              //.text(function(d) { return d.id });
              .text(function(d) { return d.name });

  function ticked(){
    link
        .attr('x1', function(d) { return d.source.x; })
        .attr('y1', function(d) { return d.source.y; })
        .attr('x2', function(d) { return d.target.x; })
        .attr('y2', function(d) { return d.target.y; });

    node
        .attr('transform',function(d){return 'translate('+d.x+','+d.y+')';});
  }

  simulation
      .nodes(graph.nodes)
      .on('tick',ticked);

  simulation.force('link')
      .links(graph.links);

});

function dragstarted(d) {
  if (!d3.event.active) simulation.alphaTarget(0.3).restart();
  d.fx = d.x;
  d.fy = d.y;
}

function dragged(d) {
  d.fx = d3.event.x;
  d.fy = d3.event.y;
}

function dragended(d) {
  if (!d3.event.active) simulation.alphaTarget(0);
  d.fx = null;
  d.fy = null;
}

    }//endif:#d3_force












/*               Collapsible Sunburst                     */


if($('svg#d3_sunburst').length){

    var width=$('svg#d3_sunburst').width(),
        height=$('svg#d3_sunburst').height(),
        radius=(Math.min(width,height)/2);

    var formatNumber=d3.format(',d');

    var x=d3.scaleLinear()
            .range([0,2*Math.PI]);

    var y=d3.scaleSqrt()
            .range([0,radius]);

    var color=d3.scaleOrdinal(d3.schemeCategory10);

    var partition=d3.partition();

    var arc=d3.arc()
        .startAngle(function(d) { return Math.max(0, Math.min(2 * Math.PI, x(d.x0))); })
        .endAngle(function(d) { return Math.max(0, Math.min(2 * Math.PI, x(d.x1))); })
        .innerRadius(function(d) { return Math.max(0, y(d.y0)); })
        .outerRadius(function(d) { return Math.max(0, y(d.y1)); });

    var svg2=d3.select('svg#d3_sunburst')
        .attr('width',width)
        .attr('height',height)
      .append('g')
        .attr('transform','translate('+width/2+','+(height/2)+')');


    d3.json('/connectivity/feeds/json_sunburst_d3',function(error,root){

        if(error) throw error;

  root=d3.hierarchy(root);
  root.sum(function(d) { return d.size; });
  svg2.selectAll('path')
      .data(partition(root).descendants())
    .enter().append('path')
      .attr('d',arc)
      .style('fill',function(d) { return color((d.children ? d : d.parent).data.name); })
      .on('click',click)
    .append('title')
      .text(function(d){return d.data.name+"\n"+formatNumber(d.value);});


/*        var node=svg2.selectAll('path')
            .data(partition.nodes(root))
            .enter().append('path')
            .attr('class','node')
            .attr('id',function(d){return('organelle_'+d.name);})
            .attr('d',arc)
            .style('fill', function(d) { return color((d.children ? d : d.parent).name); })
            .on('click',click)
            .append('title')
            .text(function(d) { return d.name + "\n" + formatNumber(d.value); });

        node.append('text')
            .attr('dx', 12)
            .attr('dy',10)
            .text(function(d){return d.name;});
*/



    });

    function click(d){
      svg2.transition()
          .duration(750)
          .tween('scale',function(){
            var xd=d3.interpolate(x.domain(),[d.x0,d.x1]),
                yd=d3.interpolate(y.domain(),[d.y0,1]),
                yr=d3.interpolate(y.range(),[d.y0 ? 20:0,radius]);
            return function(t){x.domain(xd(t)); y.domain(yd(t)).range(yr(t)); };
          })
        .selectAll('path')
          .attrTween('d',function(d) { return function() { return arc(d); }; });
    }

    d3.select(self.frameElement).style('height',height+'px');

}//endif:#d3_sunburst


/*
    $('#d3_sunburst svg g path')
        .mouseover(function(){
            $(this).parent().css('stroke','rgba(255,255,255,.5)');
            $(this).parent().css('color','rgba(255,0,0,.75)');
        })
        .mouseout(function(){
            $(this).parent().css('stroke','rgba(255,255,255,.25)');
            $(this).parent().css('color','rgba(255,255,255,.9)');
        });
*/

















if($('#serpent').length){

/*
    var svg3=d3.select('#serpentviz'),
        width=+svg3.attr('width'),
        height=+svg3.attr('height');

    var formatNumber=d3.format(',.0f'),
        format=function(d){return formatNumber(d)+' TWh';},
        color=d3.scaleOrdinal(d3.schemeCategory10);

    var sankey=d3.sankey()
        .nodeWidth(15)
        .nodePadding(10)
        .extent([[1,1],[width-1,height-6]]);

    var link=svg3.append('g')
        .attr('class','links')
        .attr('fill','none')
        .attr('stroke','#000')
        .attr('stroke-opacity',0.2)
      .selectAll('path');

    var node=svg3.append('g')
        .attr('class','nodes')
        .attr('font-family','sans-serif')
        .attr('font-size',10)
      .selectAll('g');


    d3.json('/sites/ouroboros.orgnsm.org/files/energy.json',function(error,graph){

        if(error) throw error;

        sankey(graph);

        link=link
            .data(graph.links)
            .enter().append('path')
            .attr('d',d3.sankeyLinkHorizontal())
            .attr('stroke-width',function(d) { return Math.max(1, d.width); });

        link.append('title')
            .text(function(d) { return d.source.name + ' ? ' + d.target.name + "\n" + format(d.value); });

        node=node
                 .data(graph.nodes)
                 .enter().append('g');

        node.append('rect')
            .attr('x', function(d) { return d.x0; })
            .attr('y', function(d) { return d.y0; })
            .attr('height', function(d) { return d.y1 - d.y0; })
            .attr('width', function(d) { return d.x1 - d.x0; })
            .attr('fill', function(d) { return color(d.name.replace(/ .* /,'')); })
            .attr('stroke', '#000');

        node.append('text')
          .attr('x', function(d) { return d.x0 - 6; })
          .attr('y', function(d) { return (d.y1 + d.y0) / 2; })
          .attr('dy', '0.35em')
          .attr('text-anchor', 'end')
          .text(function(d) { return d.name; })
        .filter(function(d) { return d.x0 < width / 2; })
          .attr('x', function(d) { return d.x1 + 6; })
          .attr('text-anchor', 'start');

        node.append('title')
            .text(function(d) { return d.name + "\n" + format(d.value); });

    });

*/


    // set the dimensions and margins of the graph
    var margin={top:20,right:10,bottom:20,left:10};

    // format variables
    var formatNumber = d3.format(',.0f'),    // zero decimal places
        format=function(d){return formatNumber(d)+' Widgets';},
        color = d3.scaleOrdinal(d3.schemeCategory10);

    var width=$('#serpentviz').width(),
        height=$('#serpentviz').height();

    // append the svg object to the body of the page
    var svg3=d3.select('#serpentviz')
        .attr('width',width)
        .attr('height',height)
      .append('g')
        .attr('transform', 
              'translate(' + margin.left + ',' + margin.top + ')');

    // Set the sankey diagram properties
    var sankey=d3.sankey()
        .nodeWidth(36)
        .nodePadding(40)
        .size([width, height]);

    var path = sankey.link();

    // load the data
    //d3.json('/connectivity/feeds/json_sunburst_d3',function(error,root){
    //d3.json('/connectivity/feeds/json_ForceDirected_d3',function(error,graph){
    d3.json('/sites/ouroboros.orgnsm.org/files/d3_energy.json',function(error,graph){

  sankey
      .nodes(graph.nodes)
      .links(graph.links)
      .layout(32);

// add in the links
  var link = svg3.append('g').selectAll('.link')
      .data(graph.links)
    .enter().append('path')
      .attr('class','link')
      .attr('d',path)
      .style('stroke-width',function(d) { return Math.max(1, d.dy); })
      .sort(function(a, b) { return b.dy - a.dy; });

// add the link titles
  link.append('title')
        .text(function(d) {
    		return d.source.name + ' → ' + 
                d.target.name + "\n" + format(d.value); });

// add in the nodes
  var node = svg3.append('g').selectAll('.node')
      .data(graph.nodes)
    .enter().append('g')
      .attr('class','node')
      .attr('transform',function(d){
		  return 'translate(' + d.x + ',' + d.y + ')'; })
      .call(d3.drag()
        .subject(function(d) {
          return d;
        })
        .on('start',function(){
          this.parentNode.appendChild(this);
        })
        .on('drag',dragmove));

// add the rectangles for the nodes
  node.append('rect')
      .attr('height',function(d){return Math.abs(d.dy);})
      .attr('width',sankey.nodeWidth())
      .style('fill',function(d){
		  return d.color=color(d.name.replace(/ .*/,''));})
      .style('stroke',function(d){
		  return d3.rgb(d.color).darker(2); })
    .append('title')
      .text(function(d){
		  return d.name+"\n"+format(d.value);});

// add in the title for the nodes
  node.append('text')
      .attr('x',-6)
      .attr('y', function(d) { return d.dy / 2; })
      .attr('dy', '.35em')
      .attr('text-anchor', 'end')
      .attr('transform', null)
      .text(function(d) { return d.name; })
    .filter(function(d) { return d.x < width / 2; })
      .attr('x', 6 + sankey.nodeWidth())
      .attr('text-anchor','start');

// the function for moving the nodes
  function dragmove(d) {
    d3.select(this)
      .attr('transform', 
            'translate(' 
               +d.x+',' 
               +(d.y=Math.max(
                  0,Math.min(height-d.dy,d3.event.y))
                 )+')');
    sankey.relayout();
    link.attr('d',path);
  }
});


}//endif:#serpent









if($('svg#d3_edge').length){

    //var color=d3.scaleOrdinal(d3.schemeCategory10);

    var diameter=($('svg#d3_edge').width()-20),
        radius=diameter/2,
        innerRadius=radius-120;

    var cluster=d3.cluster()
                  .size([360,innerRadius]);

    var line=d3.radialLine()
               .curve(d3.curveBundle.beta(0.85))
               .radius(function(d) { return d.y; })
               .angle(function(d) { return d.x / 180 * Math.PI; });

    var svg4=d3.select('svg#d3_edge')
               .attr('width',diameter)
               .attr('height',diameter)
               .append('g')
               .attr('transform','translate('+radius+','+radius+')');

    var link=svg4.append('g').selectAll('.link'),
        node=svg4.append('g').selectAll('.node');

    d3.json('/connectivity/feeds/json_contexts_hierarchical',function(error,classes){
//    d3.json('/sites/ouroboros.orgnsm.org/files/d3_flare.json',function(error,classes){
      if(error) throw error;

      var root=packageHierarchy(classes)
          .sum(function(d) { return d.size; });

      cluster(root);

      link=link
        .data(packageImports(root.leaves()))
        .enter().append('path')
          .each(function(d) { d.source = d[0], d.target = d[d.length - 1]; })
          .attr('class','link')
        .attr('stroke','rgba(250,65,250,.65)')
        .attr('stroke-width',function(d){return d.size;})
          .attr('d',line);

      node=node
        .data(root.leaves())
        .enter().append('text')
          .attr('class','node')
          .attr('dy','0.31em')
          .attr('transform',function(d){return 'rotate('+(d.x-90)+')translate('+(d.y+8)+',0)'+(d.x<180?'':'rotate(180)'); })
          .attr('text-anchor',function(d){return d.x<180?'start':'end';})
          .text(function(d){return d.data.title+','+d.data.size;});
    });

    // Lazily construct the package hierarchy from class names.
    function packageHierarchy(classes){
      var map={};

      function find(name,data){
        var node=map[name],i;
        if(!node){
          node = map[name] = data || {name: name, children: []};
          if (name.length) {
            node.parent = find(name.substring(0, i = name.lastIndexOf('.')));
            node.parent.children.push(node);
            node.key = name.substring(i + 1);
          }
        }
        return node;
      }

      classes.forEach(function(d) {
        find(d.name, d);
      });

      return d3.hierarchy(map['']);
    }

    // Return a list of imports for the given array of nodes.
    function packageImports(nodes) {
      var map = {},
          imports = [];

      // Compute a map from name to node.
      nodes.forEach(function(d) {
        map[d.data.name] = d;
      });

      // For each import, construct a link from the source to target node.
      nodes.forEach(function(d) {
        if (d.data.imports) d.data.imports.forEach(function(i) {
          imports.push(map[d.data.name].path(map[i]));
        });
      });

      return imports;
    }


}//endif:#d3_edge












if($('section#partition').length){

    var svg5=d3.select('svg#partitionviz'),
        width=+svg5.attr("width"),
        height=+svg5.attr("height");

    var format=d3.format(",d");

    var color=d3.scaleOrdinal(d3.schemeCategory10);

    var stratify=d3.stratify()
        .parentId(function(d) { return d.id.substring(0, d.id.lastIndexOf(".")); });

    var partition=d3.partition()
        .size([height,width])
        .padding(1)
        .round(true);

    d3.csv('/connectivity/feeds/counts',function(error,data){
    //d3.csv('/sites/ouroboros.orgnsm.org/files/d3_flare.csv',function(error,data){
        if(error) throw error;

        var root=stratify(data)
            .sum(function(d){ return d.value; })
            .sort(function(a,b){ return b.height - a.height || b.value - a.value; });

        partition(root);

        var cell=svg5
        .selectAll(".node")
        .data(root.descendants())
        .enter().append("g")
          .attr("class", function(d) { return "node" + (d.children ? " node--internal" : " node--leaf"); })
          .attr("transform", function(d) { return "translate(" + d.y0 + "," + d.x0 + ")"; });

        cell.append("rect")
          .attr("id", function(d) { return "rect-" + d.id; })
          .attr("width", function(d) { return d.y1 - d.y0; })
          .attr("height", function(d) { return d.x1 - d.x0; })
        .filter(function(d) { return !d.children; })
          .style("fill", function(d) { while (d.depth > 1) d = d.parent; return color(d.id); });

        cell.append("clipPath")
          .attr("id", function(d) { return "clip-" + d.id; })
        .append("use")
          .attr("xlink:href", function(d) { return "#rect-" + d.id + ""; });

        cell.append('text')
            .attr("clip-path", function(d) { return "url(#clip-" + d.id + ")"; })
            .attr("x",4)
          .selectAll("tspan")
            .data(function(d){return [d.id.substring(d.id.lastIndexOf(".")+1)," "+format(d.value)];})
          .enter().append("tspan")
            .attr("y", 13)
            .text(function(d) { return d; });

        cell.append("title")
            .text(function(d) { return d.id + "\n" + format(d.value); });
});


}














});