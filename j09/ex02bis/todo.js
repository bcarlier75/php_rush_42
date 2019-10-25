var ft_list;
var cookie = [];

$(document).ready(function(){
	$('#button').click(add);
	$('#ft_list div').click(del);
	ft_list = $('#ft_list');
	var my_cookie = document.cookie;
	//console.log(my_cookie);
	if (my_cookie) {
		cookie = JSON.parse(my_cookie);
		//console.log(cookie);
		cookie.forEach(function (elem) {
			ft_list.prepend($('<div>' + elem + '</div>').click(del));
		});
	}
});

$(window).on("beforeunload",function(){
	var todo = ft_list.children();
	var newCookie = [];
	for (var i = 0; i < todo.length; i++)
		newCookie.unshift(todo[i].innerHTML);
	//console.log(newCookie);
	document.cookie = JSON.stringify(newCookie);
})

function add(){
	var todo = prompt("Which task do you want to add?", '');
	if (todo !== '' && todo != null) {
		ft_list.prepend($('<div>' + todo + '</div>').click(del));
	}
}

function del(){
	if (confirm("Are you sure you want to delete this task ?")){
		this.remove();
	}
}
