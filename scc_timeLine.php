<!DOCTYPE html>
<html>

  <head>
    <meta charset='utf-8' />
    <meta http-equiv="X-UA-Compatible" content="chrome=1" />
    <meta name="description" content="Chronoline.js : chronoline.js is a library for making a chronology timeline out of events on a horizontal timescale." />

    <link rel="stylesheet" type="text/css" media="screen" href="stylesheets/stylesheet.css">

    <title>Chronoline.js</title>
  </head>

  <body>

    <!-- HEADER -->
    <!--
    <div id="header_wrap" class="outer">
        <header class="inner">
          <a id="forkme_banner" href="https://github.com/StoicLoofah/chronoline.js">View on GitHub</a>

          <h1 id="project_title">Chronoline.js</h1>
          <h2 id="project_tagline">chronoline.js is a library for making a chronology timeline out of events on a horizontal timescale.</h2>

            <section id="downloads">
              <a class="zip_download_link" href="https://github.com/StoicLoofah/chronoline.js/zipball/master">Download this project as a .zip file</a>
              <a class="tar_download_link" href="https://github.com/StoicLoofah/chronoline.js/tarball/master">Download this project as a tar.gz file</a>
            </section>
        </header>
    </div>
    -->

    <!-- MAIN CONTENT -->
    <!--
    <div id="main_content_wrap" class="outer">
      <section id="main_content" class="inner">


      <p>Welcome to the chronoline.js demo page. chronoline.js is a library for making a chronology timeline out of events on a horizontal timescale. From a list of dates and events, it can generate a graphical representation of schedules, historical events, deadlines, and more. Below are 3 examples with events from the 2012 MLB Regular Season.</p>
      <h2>Monthly Timeline</h2>
      <p>This day-by-day timeline shows off a few features. The events are automatically stacked compactly when they overlap, whether over a single point or a range. Notice how the month labels stick to the edges when you scroll forward and past the first day of the month.</p>
      <div id="target1" class="timeline-tgt">
        <input id="to-today" type="button" value="Go To Today" />
      </div>
      <h2>Quarterly Timeline</h2>
      <p>Timelines can appear on different scales simply by plugging in one of a few existing defaults or by providing custom functions for it. Additionally, there are different options for how you want (or don't want) to highlight today on the timeline. If qtip is used, events also have tooltips.</p>
      <p>This timeline also has dragging enabled, so click, hold, and drag to try that out.</p>
      <div id="target2" class="timeline-tgt">
      </div>
      <h2>Yearly Timeline</h2>
      <p>Even at a very large scope, chronoline.js still functions. Events are stacked differently because there isn't enough space to place them adjacently anymore.</p>
      <p>And if you didn't notice, the left and right arrows support both single clicks for discrete jumps and click-and-hold to scroll continuously.</p>
      <div id="target3" class="timeline-tgt">
      </div>

<h2>Support</h2>

<p>I mostly don't know what versions of various components are required. So far, I have used:</p>

<ul>
<li>raphael.js: 2.1.0</li>
<li>jQuery: 1.7.2</li>
<li><a href="http://qtip2.com/">qTip2</a>: 2.0.1</li>
</ul><p>Browser support is:</p>

<ul>
<li>Internet Explorer 8+</li>
<li>Firefox 12+</li>
<li>Chrome 18+</li>
</ul><h2>Credits</h2>

<ul>
  <li>Built by and for <a href="https://zanbato.com">Zanbato</a>.</li>
  <li>Developed by Kevin Leung (<a href="http://kevinleung.com">website</a>, <a href="https://github.com/StoicLoofah">github</a>)</li>
  <li>Designed by Deny Khoung (<a href="http://twitter.com/#!/denykhoung">twitter</a>, <a href="https://github.com/denyk">github</a>)</li>
  <li>Additional help from Dan Settel and Brandon Kwock</li>
</ul>

      </section>
    </div>
    -->

    <!-- FOOTER  -->
    <!--
    <div id="footer_wrap" class="outer">
      <footer class="inner">
        <p class="copyright">Chronoline.js is maintained by <a href="https://github.com/StoicLoofah">StoicLoofah</a> and licensed under the MIT license.</p>
        <p>Published with <a href="http://pages.github.com">GitHub Pages</a></p>
      </footer>
    </div>
    -->

    <input id="idSegui" type="hidden" value="<?php print $_GET['id']; ?>" >

        <div id="target0" class="timeline-tgt">
          <!--<input id="to-today0" type="button" value="Dia actual" />-->
    </div>

    <div id="target1" class="timeline-tgt">
         <!-- <input id="to-today1" type="button" value="Dia actual" />-->
    </div>

    <div id="target2" class="timeline-tgt">
         <!-- <input id="to-today2" type="button" value="Dia actual" />-->
    </div>

    <div id="target3" class="timeline-tgt">
          <!--<input id="to-today3" type="button" value="Dia actual" />-->
    </div>

        <div id="target4" class="timeline-tgt">
          <!--<input id="to-today4" type="button" value="Dia actual" />-->
    </div>

        <div id="target5" class="timeline-tgt">
          <!--<input id="to-today5" type="button" value="Dia actual" />-->
    </div>

        <div id="target6" class="timeline-tgt">
          <!--<input id="to-today6" type="button" value="Dia actual" />-->
    </div>

      <div id="target7" class="timeline-tgt">
          <!--<input id="to-today7" type="button" value="Dia actual" />-->
    </div>

      <div id="target8" class="timeline-tgt">
          <!--<input id="to-today8" type="button" value="Dia actual" />-->
    </div>

    <div id="target9" class="timeline-tgt">
    </div>

    <div id="target10" class="timeline-tgt">
    </div>

    <div id="target11" class="timeline-tgt">
    </div>

    <div id="target12" class="timeline-tgt">
    </div>

    <div id="target13" class="timeline-tgt">
    </div>

    <div id="target14" class="timeline-tgt">
    </div>

    <div id="target15" class="timeline-tgt">
    </div>

    <div id="target16" class="timeline-tgt">
    </div>

    <div id="target17" class="timeline-tgt">
    </div>

    <div id="target18" class="timeline-tgt">
    </div>

    <div id="target19" class="timeline-tgt">
    </div>

    <div id="target20" class="timeline-tgt">
    </div>


    <script type="text/javascript" src="libJquery/chronoline/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="libJquery/chronoline/jquery.qtip.min.css" />
    <script type="text/javascript" src="libJquery/chronoline/jquery.qtip.min.js"></script>

    <script type="text/javascript" src="libJquery/chronoline/raphael-min.js"></script>

    <link rel="stylesheet" type="text/css" href="libJquery/chronoline/chronoline.css" />
    <script type="text/javascript" src="libJquery/chronoline/chronoline.js"></script>

    <script type="text/javascript">

      
      $(document).ready(function(){

      /* MY TIMELINE */
      //events=[];
      //sections=[];
      acum="";

      var fecha = new Date();
      var ano = fecha.getFullYear();
      var mes= fecha.getMonth()+1;
      var dia=fecha.getDate();

      console.log(ano+" "+mes+" "+dia);

      param="id="+document.getElementById('idSegui').value;
      param=param+"&json="+"lineTime";
      $.getJSON('json/scc_detSegui_json.php?'+param,{format: "json"}, function(data) 
      {
            /*for(i=0;i<data.length;i++)
            {
              events.push({dates:[new Date(2014,6,5)],title:i,section:i});
            }*/

            // SECCION DE APERTURA DEL PROYECTO
              fechIni=new Array();
              fechIni=data[0]['fechIni'].split("-",data[0]['fechIni'].length);
              año3=fechIni[0];
              mes3=parseInt(fechIni[1]);
              dia3=fechIni[2];
              console.log(mes3);

            // SECCION DE ENTREGA DEL PROYECTO
              fechFin=new Array();
              fechFin=data[0]['fechFin'].split("-",data[0]['fechFin'].length);
              año6=fechFin[0];
              mes6=parseInt(fechFin[1]);
              dia6=fechFin[2];
              console.log(mes6);

            // ARRAY DE COLORES
              colorArr=["#6E7ABB",
                        "#002957",
                        "#00B8B0",
                        "#E1D307",
                        "#004023",
                        "#84BB4C",
                        "#E2CF70",
                        "#F0533F",
                        "#EC80B3",
                        "#893373",
                        "#8869AE",
                        "#CAAA77",
                        "#CAAA77",
                        "#A12836",
                        "#F47920"];
              leterArr=["","A","B","C","D","E","F","G","H","I","J"];

              //sections.push({dates:[new Date(año3,mes3-1,dia3),new Date(ano,mes-1,dia)],title:data[0]['centVal']+"-"+data[0]['desProye'],section:0,attrs:{fill:"#CCCCCC"}});
              //events.push({dates:[new Date(año3,mes3-1,dia3),new Date(año6,mes6-1,dia6)],title:data[0]['centVal']+"-"+data[0]['desProye'],section:1,attrs:{fill:"#C8523A",stroke:"#C8523A"}});


            for(i=0;i<data.length;i++)
            {
              console.log("tam arr:"+data.length);

              events=[];
              sections=[];

              flagPlaz=0;
              flagHit=0;

              sections.push({dates:[new Date(año3,mes3-1,dia3),new Date(ano,mes-1,dia)],title:data[0]['centVal']+"-"+data[0]['desProye'],section:0,attrs:{fill:"#CCCCCC"}});

              if(año6>0)
              {
                events.push({dates:[new Date(año3,mes3-1,dia3),new Date(año6,mes6-1,dia6)],title:data[0]['ordDes'],section:1,attrs:{fill:"#C8523A",stroke:"#C8523A"}});
              }
              else
              {
                events.push({dates:[new Date(año3,mes3-1,dia3)],title:data[0]['ordDes'],section:1,attrs:{fill:"#C8523A",stroke:"#C8523A"}});
              }

              // EVALUAR PLAZOS ADICIONALES

              if(data[i]['termDay']>0)
              {
                fechPlaz=new Date(año6,mes6-1,dia6);
                fechPlazGood1=new Date(fechPlaz.getTime()+(data[i]['termDay'] * 24 * 3600 * 1000));
                console.log("aaa:"+fechPlazGood1);
                events.push({dates:[new Date(año6,mes6-1,dia6),fechPlazGood1],title:data[0]['ordDes'],section:1,attrs:{fill:"#FF0000",stroke:"#FF0000"}});
              }
              else
              {
                excep="Ningun dia adicional por evaluar";                
              }

              // EVALUAR PLAZOS INTERNACIONALES
              
              if(data[i]['plazExter']>0)
              {
                fechPlaz=fechPlazGood1;
                fechPlazGood2=new Date(fechPlaz.getTime()+(data[i]['plazExter'] * 24 * 3600 * 1000));
                console.log("aaa:"+fechPlazGood2);
                events.push({dates:[fechPlazGood1,fechPlazGood2],title:data[0]['ordDes'],section:1,attrs:{fill:"#FBE12A",stroke:"#FBE12A"}});
              }
              else
              {
                excep="Ningun dia adicional por evaluar";
              }

              // EVALUAR PLAZOS INTERNOS
              
              if(data[i]['plazInter']>0)
              {
                fechPlaz=fechPlazGood2;
                fechPlazGood3=new Date(fechPlaz.getTime()+(data[i]['plazInter'] * 24 * 3600 * 1000));
                console.log("aaa:"+fechPlazGood3);
                events.push({dates:[fechPlazGood2,fechPlazGood3],title:data[0]['ordDes'],section:1,attrs:{fill:"#2BE714",stroke:"#2BE714"}});
              }
              else
              {
                excep="Ningun dia adicional por evaluar";
              }


              fechParti=new Array();
              fechParti=data[i]['fechParti'].split("-",data[i]['fechParti'].length);
              año1=fechParti[0];
              mes1=parseInt(fechParti[1]);
              dia1=fechParti[2];
              console.log(mes1);

              fechEntre=new Array();
              fechEntre=data[i]['fechEntre'].split("-",data[i]['fechEntre'].length);
              año2=fechEntre[0];
              mes2=parseInt(fechEntre[1]);
              dia2=fechEntre[2];
              console.log(mes2);

              fechParti2=new Array();
              fechParti2=data[i]['fechProvParti'].split("-",data[i]['fechProvParti'].length);
              año4=fechParti2[0];
              mes4=parseInt(fechParti2[1]);
              dia4=fechParti2[2];
              console.log(mes4);

              fechEntre2=new Array();
              fechEntre2=data[i]['fechEntreProv'].split("-",data[i]['fechEntreProv'].length);
              año5=fechEntre2[0];
              mes5=parseInt(fechEntre2[1]);
              dia5=fechEntre2[2];
              console.log(mes5);

              for(j=1;j<=11;j++)
              {

                if(data[i]["f"+j]!=null)
                {
                  fech=new Array();
                  fech=data[i]["f"+j].split("-",data[i]["f"+j].length);
                  año7=fech[0];
                  mes7=parseInt(fech[1]);
                  dia7=fech[2];
                  console.log(mes7);

                  if((fech.length==3 && fech.length==3 && año7>0 ))
                  {
                    events.push({dates:[new Date(año7,mes7-1,dia7)],title:data[i]['ordDes']+" ( "+leterArr[j]+" )",section:j,attrs:{fill:colorArr[i],stroke:colorArr[i]}});
                  }
                  console.log(data[i]["f"+j]);
                }
              }

              if((fechParti.length==3 && fechEntre.length==3))
              {

                // VALIDAR PLAZOS CLIENTE
                if(data[i]['fechEntre']!=data[i]['fechParti'])
                {
                  events.push({dates:[new Date(año1,mes1-1,dia1),new Date(año2,mes2-1,dia2)],title:data[i]['ordDes'],section:j,attrs:{fill:colorArr[i],stroke:"black"}});
                }
                else
                {
                  events.push({dates:[new Date(año1,mes1-1,dia1)],title:data[i]['ordDes'],section:j,attrs:{fill:colorArr[i],stroke:"black"}});
                }

              }

              /*
                  if((fechParti2.length==3 && fechEntre2.length==3))
                  {

                    // VALIDAR PLAZOS PROVEEDOR
                    if(data[i]['fechEntreProv']!=data[i]['fechProvParti'])
                    {
                      events.push({dates:[new Date(año4,mes4-1,dia4),new Date(año5,mes5-1,dia5)],title:data[i]['ordDes'],section:i,attrs:{fill:"#D76728",stroke:"#D76728"}});
                      //sections.push({dates:[new Date(año1,mes1-1,dia1),new Date(año2,mes2-1,dia2)],title:data[i]['ordDes'],section:i,attrs:{fill:"#d4e3fd"}});
                    }
                    else
                    {
                      events.push({dates:[new Date(año4,mes4-1,dia4)],title:data[i]['ordDes'],section:i,attrs:{fill:"#D76728",stroke:"#D76728"}});
                    }

                  }
              */


                 ind=i;

                 console.log('timeline:'+'timeline'+i);
                 window["timeline"+ind]=new Chronoline(document.getElementById("target"+ind), events,
                  {
                      visibleSpan: DAY_IN_MILLISECONDS * 366,
                      //visibleSpan: DAY_IN_MILLISECONDS * 91,
                      //visibleSpan: DAY_IN_MILLISECONDS * 221,
                      //fitVisibleSpan:false,
                      animated: false,
                      tooltips: true,
                      defaultStartDate: new Date(ano-1, 1, 1),
                      endDate:new Date(2020, 1, 1),
                      sections: sections,
                      sectionLabelAttrs: {'fill': '#997e3d', 'font-weight': 'bold'},
                      labelInterval: isHalfMonth,
                      hashInterval: isHalfMonth,
                      //labelInterval: isFifthDay,
                      //hashInterval: isFifthDay,
                      scrollLeft: prevQuarter,
                      scrollRight: nextQuarter,
                      //floatingSubLabels: false,
                      draggable: true
                  });

                eval("var arr"+ind+"=eval(window['timeline"+ind+"']);");

                //document.getElementById('to-today'+ind).removeAttribute("onclick");
                //document.getElementById('to-today'+ind).setAttribute("onclick","scc_getToday('"+ind+"')");                

                //$('#to-today'+0).click(function(){eval('arr'+0+'.goToToday();');});
                eval('arr'+ind+'.goToToday()');
  
            }


            /*
                var timeline1 = new Chronoline(document.getElementById("target9"), events,
                {
                  animated: true,
                  tooltips: true,
                  defaultStartDate: new Date(ano, 1, 1),
                  sections: sections,
                  sectionLabelAttrs: {'fill': '#997e3d', 'font-weight': 'bold'},
                });
            */

            //eval("var x=1;");
            //this['y']=2;

            /*
                this['timeline'+1]=new Chronoline(document.getElementById("target1"), events,
                {
                    //visibleSpan: DAY_IN_MILLISECONDS * 366,
                    visibleSpan: DAY_IN_MILLISECONDS * 91,
                    animated: false,
                    tooltips: true,
                    defaultStartDate: new Date(ano, 1, 1),
                    sections: sections,
                    sectionLabelAttrs: {'fill': '#997e3d', 'font-weight': 'bold'},
                    //labelInterval: isHalfMonth,
                    //hashInterval: isHalfMonth,
                    labelInterval: isFifthDay,
                    hashInterval: isFifthDay,
                    scrollLeft: prevQuarter,
                    scrollRight: nextQuarter,
                    //floatingSubLabels: false,
                    draggable: true
                });

              eval("var arr"+1+"=eval(this['timeline1']);");

            */
          

          //eval("var timeline"+1+"="+timeline);
          //console.log(timeline1);

          //console.log(x);
          //console.log(this['y']);
          //console.log(arr1);  

          //$('#to-today1').click(function(){eval("arr"+1+".goToToday();");});


          /*
              this['timeline'+2] = new Chronoline(document.getElementById("target2"), events,
              {
                  visibleSpan: DAY_IN_MILLISECONDS * 366,
                  //visibleSpan: DAY_IN_MILLISECONDS * 91,
                  animated: false,
                  tooltips: true,
                  defaultStartDate: new Date(ano, 1, 1),
                  sections: sections,
                  sectionLabelAttrs: {'fill': '#997e3d', 'font-weight': 'bold'},
                  labelInterval: isHalfMonth,
                  hashInterval: isHalfMonth,
                  scrollLeft: prevQuarter,
                  scrollRight: nextQuarter,
                  floatingSubLabels: false,
              });

            eval("var arr"+2+"=eval(this['timeline2']);");

            $('#to-today2').click(function(){eval("arr"+2+".goToToday();");});

          */

      });

      /*
          var events = [
          {dates: [new Date(2014, 6, 5)], title: "EW-2014-111-1", section: 0},
          {dates: [new Date(2014, 6, 20)], title: "EW-2014-111-1", section: 1}
          ];

          var sections = [
          {dates: [new Date(2014, 6, 1), new Date(2014, 6, 5)], title: "EW-2014-111-1", section: 0, attrs: {fill: "#d4e3fd"}},
          {dates: [new Date(2014, 6, 15), new Date(2014, 6, 20)], title: "EW-2014-111-1", section: 1, attrs: {fill: "#d4e3fd"}}
          ];

          var fecha = new Date();
          var ano = fecha.getFullYear()

           var timeline1 = new Chronoline(document.getElementById("target9"), events,
            {animated: true,
             tooltips: true,
             defaultStartDate: new Date(ano, 1, 1),
             sections: sections,
             sectionLabelAttrs: {'fill': '#997e3d', 'font-weight': 'bold'},
          });

          $('#to-today').click(function(){timeline1.goToToday();});

          console.log(new Date(2014, 6, 5));
      */

      /*
          var events = [
          {dates: [new Date(2011, 2, 31)], title: "2011 Season Opener", section: 0},
          {dates: [new Date(2012, 1, 29)], title: "Spring Training Begins", section: 2},
          {dates: [new Date(2012, 3, 5)], title: "Atlanta Braves @ New York Mets Game 1", section: 1},
          {dates: [new Date(2012, 3, 7)], title: "Atlanta Braves @ New York Mets Game 2", section: 1},
          {dates: [new Date(2012, 3, 8)], title: "Atlanta Braves @ New York Mets Game 3", section: 1},
          {dates: [new Date(2012, 3, 9), new Date(2012, 3, 11)], title: "Atlanta Braves @ Houston Astros", section: 1},
          {dates: [new Date(2012, 3, 13), new Date(2012, 3, 15)], title: "Milwaukee Brewers @ Atlanta Braves", section: 1},
          {dates: [new Date(2012, 3, 9), new Date(2012, 3, 11)], title: "Boston Red Sox @ Toronto Blue Jays", section: 1},
          {dates: [new Date(2012, 3, 13), new Date(2012, 3, 15)], title: "Baltimore Orioles @ Toronto Blue Jays", section: 1},
          {dates: [new Date(2012, 3, 17), new Date(2012, 3, 19)], title: "Tampa Bay Rays @ Toronto Blue Jays", section: 1},
          {dates: [new Date(2012, 3, 20), new Date(2012, 3, 23)], title: "Toronto Blue Jays @ Kansas City Royals", section: 1},
          {dates: [new Date(2012, 3, 5)], title: "Opening Day for 12 Teams", section: 1},
          {dates: [new Date(2012, 02, 28)], title: "Seattle Mariners v. Oakland A's", section: 1, description: "Played in Japan!"},
          {dates: [new Date(2012, 4, 18), new Date(2012, 5, 24)], title: "Interleague Play", section: 1},
          {dates: [new Date(2012, 5, 10)], title: "All-Star Game", section: 1},
          {dates: [new Date(2012, 9, 24)], title: "World Series Begins", section: 3}
          ];

          var sections = [
          {dates: [new Date(2011, 2, 31), new Date(2011, 9, 28)], title: "2011 MLB Season", section: 0, attrs: {fill: "#d4e3fd"}},
          {dates: [new Date(2012, 2, 28), new Date(2012, 9, 3)], title: "2012 MLB Regular Season", section: 1, attrs: {fill: "#d4e3fd"}},
          {dates: [new Date(2012, 1, 29), new Date(2012, 3, 4)], title: "Spring Training", section: 2, attrs: {fill: "#eaf0fa"}},
          {dates: [new Date(2012, 9, 4), new Date(2012, 9, 31)], title: "2012 MLB Playoffs", section: 3, attrs: {fill: "#eaf0fa"}}
          ];

          var timeline1 = new Chronoline(document.getElementById("target1"), events,
            {animated: true,
             tooltips: true,
             defaultStartDate: new Date(2012, 3, 5),
             sections: sections,
             sectionLabelAttrs: {'fill': '#997e3d', 'font-weight': 'bold'},
          });

          $('#to-today').click(function(){timeline1.goToToday();});

          var sections2 = [
          {dates: [new Date(2011, 2, 31), new Date(2011, 9, 28)], title: "2011 MLB Season", section: 0, attrs: {fill: "##e3f0fe"}},
          {dates: [new Date(2012, 2, 28), new Date(2012, 9, 3)], title: "2012 MLB Regular Season", section: 1, attrs: {fill: "#e3f0fe"}},
          {dates: [new Date(2012, 1, 29), new Date(2012, 3, 4)], title: "Spring Training", section: 2, attrs: {fill: "#cce5ff"}},
          {dates: [new Date(2012, 9, 4), new Date(2012, 9, 31)], title: "2012 MLB Playoffs", section: 3, attrs: {fill: "#cce5ff"}}
          ];

          var timeline2 = new Chronoline(document.getElementById("target2"), events,
            {visibleSpan: DAY_IN_MILLISECONDS * 91,
          animated: true,
             tooltips: true,
             defaultStartDate: new Date(2012, 3, 5),
             sections: sections2,
             sectionLabelAttrs: {'fill': '#997e3d', 'font-weight': 'bold'},
          labelInterval: isFifthDay,
          hashInterval: isFifthDay,
          scrollLeft: prevMonth,
          scrollRight: nextMonth,
          markToday: 'labelBox',
             draggable: true
          });

          var timeline3 = new Chronoline(document.getElementById("target3"), events,
            {visibleSpan: DAY_IN_MILLISECONDS * 366,
          animated: true,
             tooltips: true,
             defaultStartDate: new Date(2012, 3, 5),
             sections: sections,
             sectionLabelAttrs: {'fill': '#997e3d', 'font-weight': 'bold'},
          labelInterval: isHalfMonth,
          hashInterval: isHalfMonth,
          scrollLeft: prevQuarter,
          scrollRight: nextQuarter,
          floatingSubLabels: false,
          });
      */

      });
 
    </script>

  </body>
</html>
