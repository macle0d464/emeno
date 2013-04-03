(function($) {
	$.fn.autosave = function(prefix) {
		var storage = localStorage;
		var $this = $(this);
		
		if (!prefix) { prefix = $this.attr('id'); }
		prefix += ">";
		
		function save() {
			$this.find('input:not(:submit)').each(function(index, element) {
				var key = prefix + element.name;
				if ($(element).attr('type') == 'checkbox') {
					storage.setItem(key, $(element).prop("checked"));
				} else {
					storage.setItem(key, $(element).val());
				}
			});
			$this.find('select').each(function(index, element) {
				var key = prefix + element.name;
				storage.setItem(key, $(element).val());
			});
			
		} 
		
		function restore() {
			var key, value, i, el;
			
			for (i=0; i < storage.length; i++) {
				key = storage.key(i);
				if (key.indexOf(prefix) == 0) {
					value = storage.getItem(key);
					key = key.substring(prefix.length);
					// console.log("key = " + key + ", value = " + value);
					el = $("#" + key);
					if (el.attr('type') == 'checkbox') {
						if (value == "true") {
							value = true;
						} else {
							value = false;
						}
						el.prop("checked", value);
						togglebox(el, value);						
					} else {
						el.val(value);
					}
					if (el.is('select')) {
						toggle(el, value);
					}					
				}
			}
			
		}
		
		function clear() {
			
		}
		
		$this.change(save);
		$this.submit(clear);
		
		restore();
	}
})(jQuery);