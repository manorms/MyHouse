<?php

?>

<!DOCTYPE html>
<html>
<?php echo $this->Facebook->html(); ?>
<head>
	<?php echo $this->Html->charset(); ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="MyHouseSystem">
    <meta name="author" content="Orlando">
	<title>
		<?php echo NAME_SYSTEM ?>:
		<?php echo $title_for_layout; ?>
	</title>

	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap');
		//echo $this->Html->css('bootstrap-theme.min');
		echo $this->Html->css('custom');
		echo $this->Html->css('dashboard');
		echo $this->Html->css('jquery.dataTables');

		echo $this->Html->script('jquery-2.0.3.min');
		echo $this->Html->script('bootstrap.min.js');
		echo $this->Html->script('jquery.metadata');
		echo $this->Html->script('jquery.validate.min');
		echo $this->Html->script('jquery.dataTables');



		echo $this->fetch('meta');
		echo $this->fetch('css');
		//echo $this->fetch('script');
	?>

</head>
<?php //echo $this->element('sql_dump'); ?>

<body style='height:100%;' >
	<div id="container" style='min-height:100%; position:relative;'>
		<div class="header">
			<?php
				if ( $this->params['action'] != 'reset_password' && $this->params['action'] != 'login'  && $this->Session->read("Auth.User.id") != "")
					echo $this->element('header');
				else
					echo $this->element('headerLogin');
			?>
		</div>
		<div class="content container-fluid">
		  <div class="row">
			<div class="col-sm-3 col-md-2 sidebar">
			<?php
				echo $this->element('leftMenu');
			?>
			</div>
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Session->flash('auth'); ?>
				<?php echo $this->fetch('content'); ?>
				<div id="status">
				</div>
				<div id="fb-root">
				</div>

			</div>
		  </div>
		</div>

		<div class=" footer">
			<?php //echo $this->element('sql_dump'); ?>
			<?php
				 echo $this->element('footer');
			?>
		</div>

	</div>
	<script>

	/* API method to get paging information */
  $.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
  {
      return {
          "iStart":         oSettings._iDisplayStart,
          "iEnd":           oSettings.fnDisplayEnd(),
          "iLength":        oSettings._iDisplayLength,
          "iTotal":         oSettings.fnRecordsTotal(),
          "iFilteredTotal": oSettings.fnRecordsDisplay(),
          "iPage":          oSettings._iDisplayLength === -1 ?
              0 : Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
          "iTotalPages":    oSettings._iDisplayLength === -1 ?
              0 : Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
      };
  }

  /* Bootstrap style pagination control */
  $.extend( $.fn.dataTableExt.oPagination, {
      "bootstrap": {
          "fnInit": function( oSettings, nPaging, fnDraw ) {
              var oLang = oSettings.oLanguage.oPaginate;
              var fnClickHandler = function ( e ) {
                  e.preventDefault();
                  if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
                      fnDraw( oSettings );
                  }
              };

			  $(nPaging).addClass('pagination').append(
                  '<ul class="pagination">'+
                      '<li class="prev disabled"><a href="#">&larr; '+oLang.sPrevious+'</a></li>'+
                      '<li class="next disabled"><a href="#">'+oLang.sNext+' &rarr; </a></li>'+
                  '</ul>'
              );
              var els = $('a', nPaging);
              $(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
              $(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
          },

          "fnUpdate": function ( oSettings, fnDraw ) {
              var iListLength = 5;
              var oPaging = oSettings.oInstance.fnPagingInfo();
              var an = oSettings.aanFeatures.p;
              var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);

              if ( oPaging.iTotalPages < iListLength) {
                  iStart = 1;
                  iEnd = oPaging.iTotalPages;
              }
              else if ( oPaging.iPage <= iHalf ) {
                  iStart = 1;
                  iEnd = iListLength;
              } else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
                  iStart = oPaging.iTotalPages - iListLength + 1;
                  iEnd = oPaging.iTotalPages;
              } else {
                  iStart = oPaging.iPage - iHalf + 1;
                  iEnd = iStart + iListLength - 1;
              }

              for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
                  // Remove the middle elements
                  $('li:gt(0)', an[i]).filter(':not(:last)').remove();

                  // Add the new list items and their event handlers
                  for ( j=iStart ; j<=iEnd ; j++ ) {
                      sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
                      $('<li '+sClass+'><a href="#">'+j+'</a></li>')
                          .insertBefore( $('li:last', an[i])[0] )
                          .bind('click', function (e) {
                              e.preventDefault();
                              oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
                              fnDraw( oSettings );
                          } );
                  }

                  // Add / remove disabled classes from the static elements
                  if ( oPaging.iPage === 0 ) {
                      $('li:first', an[i]).addClass('disabled');
                  } else {
                      $('li:first', an[i]).removeClass('disabled');
                  }

                  if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
                      $('li:last', an[i]).addClass('disabled');
                  } else {
                      $('li:last', an[i]).removeClass('disabled');
                  }
              }
          }
      }
  } );

		$(document).ready(function() {
			var oTable = $('.data-table').dataTable({
			"iDisplayLength": 25,
			"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, 'All']],
			"sPaginationType": "bootstrap"
			});
			$(".dataTables_wrapper input,.dataTables_wrapper select").addClass("custom-form-control");
			$('input[title!=\'\'],button[title!=\'\'],td[title!=\'\'],textarea[title!=\'\'],a[title!=\'\']').tooltip({placement: 'down'});
		 });

	</script>
<div id="debug"></div>
<?php
echo $this->fetch('script');
	?>
	<script>
	$(document).ready(function() {
		$("#publicidad div").remove();
		$("#publicidad").remove();
	});
	</script>
</body>
<?php echo $this->Facebook->init(); ?>
</html>
