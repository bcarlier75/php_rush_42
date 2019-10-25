var ft_list;
var cookie = [];

window.onload = function () {
	document.querySelector("#button").addEventListener("click", new_task);
	ft_list = document.querySelector("#ft_list");
	var my_cookie = document.cookie;
	//console.log(my_cookie);
	if (my_cookie) {
		cookie = JSON.parse(my_cookie);
		//console.log(cookie);
		cookie.forEach(function (elem) {
			add(elem);
		});
	}
};

window.onunload = function () {
	var todo = ft_list.children;
	var newCookie = [];
	for (var i = 0; i < todo.length; i++)
		newCookie.unshift(todo[i].innerHTML);
	//console.log(newCookie);
	document.cookie = JSON.stringify(newCookie);
};

function new_task(){
	var todo = prompt("Which task do you want to add?", '');
	if (todo !== '') {
		add(todo)
	}
}

function add(todo){
	var div = document.createElement("div");
	div.innerHTML = todo;
	div.addEventListener("click", del);
	ft_list.insertBefore(div, ft_list.firstChild);
}

function del(){
	if (confirm("Are you sure you want to delete this task ?")){
		this.parentElement.removeChild(this);
	}
}
