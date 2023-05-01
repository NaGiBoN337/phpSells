/// проверка формы на заполение 
function checkForm(form){  
	if (
		(document.getElementById("product_code").value==="")||
		(document.getElementById("product_name").value==="")||
		(document.getElementById("category_id").value==="")||
		(document.getElementById("product_price").value==="")||
		(document.getElementById("brand_id").value==="")||
		(document.getElementById("product_image").value==="")
		) 
		{
		    document.getElementById('err').innerHTML='Поля со звездочкой должны быть заполнены';  
		    return false; 
	    }
return true;  
}

/// функция работы с табами.
(function($) {
	$.fn.adminTab = function(options) {
		// первоначальные настройки: при загрузке страницы открывается первая вкладка
		var settings = $.extend({
			visibleTabIndex: 1
		}, options);

		return this.each(function() {
			var tabContainer = $(this),
			tabItem = $(this).children("ul").children("li"),
			tabContent = $(this).children(".tab-content"),
			tabReset = function() {
				if ($(window).width() > parseInt(settings.breakpoint)) {

					tabItem.css('width', 'auto');
					tabItem.children("a").css('display', 'inline-block');
					tabItem.closest("ul").show();
				} else {
					tabItem.css('width', '100%');
					tabItem.children("a").css('display', 'block');
					tabItem.closest("ul").hide();
				}
			}
			if (settings.visibleTabIndex) {
				var tabindex = parseInt(settings.visibleTabIndex) - 1;
				tabItem.removeClass('active');
				$(this).children("ul").children("li").eq(tabindex).addClass("active");
				tabContent.children(".tab-pane").removeClass("active");
				tabContent.children(".tab-pane").eq(tabindex).addClass("active");
			}
			tabItem.on('click', function() {
				var tabIndex = $(this).index();
				tabItem.removeClass('active');
				$(this).addClass('active');
				tabContent.children('.tab-pane').removeClass('active').hide();
				$(this).closest(tabContainer).find(".tab-pane").eq(tabIndex).addClass('active').show();
			});
		});
	}
}(jQuery));

// активируем вкладку
$('#adminTab').adminTab({
	visibleTabIndex: 1
});
function tryUpdate() {
    $.ajax({
			url: '../php/update_data.php',
			type: 'POST',
			dataType: "text",
			data: { username: username,
					status: status },
			error: function() {
				alert("Ошибка");
			},
			success: function (response) {
				alert(response);
			}
	});
}

var loadFile = function(event) {
	var output = document.getElementById('output');
	output.src = URL.createObjectURL(event.target.files[0]);
};

var $select1 = $('#param');
$select1.change(function() {
	$('#selector').prop('disabled', false);
	$('#selector').prop('selectedIndex', 0);
	$('#selector').val('');
	var val = this.value;
	$.ajax({
		url: '../php/delete_product.php',
		type: 'POST',
		dataType: "text",
		data: { action: 'change',
				param: val 
			},
		error: function() {
			alert("Ошибка");
		},
		success: function (response) {
			$('#param_val').html(response);
		}
	});
});



