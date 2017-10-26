(function() {

	var items = document.querySelectorAll('.tags li');
	var el = null;
	var del = document.querySelector('.delete');
	var add = document.querySelector('.add');
	var ul = document.querySelector('ul');
	var form = document.querySelector('form');

	function addListeners() {
		[].forEach.call(items, function(item) {
			item.setAttribute('draggable', 'true');
			item.addEventListener('dragstart', dragStart, false);
			item.addEventListener('dragenter', dragEnter, false);
			item.addEventListener('dragover', dragOver, false);
			item.addEventListener('dragleave', dragLeave, false);
			item.addEventListener('drop', dragDrop, false);
			item.addEventListener('dragend', dragEnd, false);
		});
	}

	del.addEventListener('dragover', delOver, false);
	del.addEventListener('dragenter', delEnter, false);
	del.addEventListener('dragleave', delLeave, false);
	del.addEventListener('drop', deleteItem, false);

	add.addEventListener('click', addItem, false);

	function dragStart(e) {
		this.style.opacity = '0.4';
		el = this;
		e.dataTransfer.effectAllowed = 'move';
		e.dataTransfer.setData('text/html', this.innerHTML);
	}

	function dragOver(e) {
		if (e.preventDefault) {
			e.preventDefault();
		}
		e.dataTransfer.dropEffect = 'move';
		return false;
	}

	function dragEnter(e) {
		this.classList.add('over');
	}

	function dragLeave(e) {
		this.classList.remove('over');
	}

	function dragDrop(e) {
		if (e.stopPropagation) {
			e.stopPropagation();
		}
		if (el != this) {
			el.innerHTML = this.innerHTML;
			this.innerHTML = e.dataTransfer.getData('text/html');
			listChange();
		}
		return false;
	}

	function delOver(e) {
		if (e.preventDefault) {
			e.preventDefault();
		}
		e.dataTransfer.dropEffect = 'move';
		return false;
	}

	function delEnter(e) {
		this.style.borderColor = 'red';
	}

	function delLeave(e) {
		this.style.borderColor = '#ccc';
	}

	function deleteItem(e) {
		if (e.stopPropagation) {
			e.stopPropagation();
		}
		deletetag(el.innerHTML);
		el.parentNode.removeChild(el);
		this.style.borderColor = '#ccc';
		return false;
	}

	function dragEnd(e) {
		this.style.opacity = '1';
		[].forEach.call(items, function(item) {
			item.classList.remove('over');
		});
	}

	function addItem(e) {
		e.preventDefault();
//		var newItem = document.createElement('li');
		var title = form.elements['tag'].value;
		if (title === '') {
			return false;
		}
		var dept1Index = form.elements['dept1'].selectedIndex;
		var dept1 = form.elements['dept1'].options[dept1Index].value;
//		var dept2Index = form.elements['dept2'].selectedIndex;
//		var dept2 = form.elements['dept2'].options[dept2Index].value;
		
		console.log(title);
		console.log(dept1);
		
		$.ajax({
			url : 'insert.php?dept='+ dept1 + '&tag=' + title,
			dataType : 'html'
		})
		.done(function(data){
			console.log(data);
//			$('#gallery').html(data);
		});

//		var newContent = title + ' - ' + dept1 + ' - ' + dept2;
//		newItem.innerHTML = newContent;

//		ul.appendChild(newItem);
//		items = document.querySelectorAll('.tags li');
//		addListeners();
//		listChange();
	}

	function listChange() {
		var tempItems = document.querySelectorAll('.tags li');
		[].forEach.call(tempItems, function(item, i) {
			var order = i + 1;
			var it = 'tag=' + item.innerHTML + '&tag_order=' + order;
			console.log(it);
			saveList(it);
		});
	}

	function saveList(item) {
		var request = new XMLHttpRequest();
		request.open('GET', 'save.php?' + item);
		request.send();
	}

	function deletetag(item) {
		var request = new XMLHttpRequest();
		request.open('GET', 'delete.php?tag=' + item);
		request.send();
	}

	addListeners();

})();