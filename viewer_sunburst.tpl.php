
<section id="sunburst">

<?php include('viewers_toolbar.tpl.php'); ?>

    <!--D3-->
    <div style="float:left;width:50%;">
        <div class="subtitle">Collapsible Ring Connectivity</div>
        <svg id="d3_sunburst"></svg>
        <div><a href="/connectivity/feeds/json_sunburst_d3" class="json-link">JSON source</a></div>
        <!--div><a href="https://bl.ocks.org/mbostock/4348373">Zoomable Sunburst</a></div>
        <div><a href="https://bl.ocks.org/maybelinot/5552606564ef37b5de7e47ed2b7dc099">Zoomable Sunburst on d3.js v4</a></div>
        <div><a href="https://bl.ocks.org/mbostock/4063423">Sunburst Partition</a></div-->
    </div>
    <div style="float:left;width:50%;min-height:450px;">
        <div class="subtitle">Hierarchical Edge Bundling</div>
        <svg id="d3_edge"></svg>
        <!--div>https://bl.ocks.org/mbostock/1044242</div>
        <div>https://bl.ocks.org/mbostock/7607999</div>
        <div>https://bl.ocks.org/mbostock/4341134</div-->
        <div><a href="/connectivity/feeds/json_contexts_hierarchical" class="json-link">JSON source</a></div>
    </div>
    <!--div style="float:left;width:50%;min-height:450px;">
        <div class="subtitle">chord diagram</div>
        <svg id="d3_chord"></svg>
        <div>https://bost.ocks.org/mike/uberdata/</div>
        <div>https://bl.ocks.org/mbostock/1046712</div>
    </div-->
    <!--div>https://bl.ocks.org/mbostock/c034d66572fd6bd6815a - tree of life</div>
    <div>https://bost.ocks.org/mike/hive/</div-->

    <!--JIT-->
    <div style="float:left;width:50%;">
        <div class="subtitle">Ring-Interconnectivity</div>
        <div id="sunburst_infovis" style="height:640px;margin:0 auto;"></div>
        <div><a href="/connectivity/feeds/json_Sunburst" class="json-link">JSON source</a></div>
    </div>
    <div style="float:left;width:50%;">
        <div class="subtitle">OuterRing-Interconnectivity</div>
        <div id="sunburst-flat_infovis" style="height:640px;margin:0 auto;"></div>
        <div><a href="/connectivity/feeds/json_Sunburst" class="json-link">JSON source</a></div>
    </div>
    <div id="log"></div>

</section>
