/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Kishor Mali
 */

$(document).ready(function(){
	
	var addUserForm = $("#addUser");
	
	var validator = addUserForm.validate({
		
		rules:{
			title : { required : true },
			first_name : { required : true },
			middle_name : { required : true },
			last_name : { required : true },
			email : { required : true, email : true, remote : { url : baseURL + "checkEmailExists", type :"post"} },
			password : { required : true },
			cpassword : {required : true, equalTo: "#password"},
			mobile : { required : true, digits : true },
			role : { required : true, selected : true},
			institution : { required : true },
			department : { required : true },
			country : { required : true },
			city : { required : true },
			orcid_id : { required : true },
			expertise_area : { required : true }
		},
		messages:{
			title : { required : "This field is required" },
			first_name : { required : "This field is required" },
			middle_name : { required : "This field is required" },
			last_name : { required : "This field is required" },
			email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
			password : { required : "This field is required" },
			cpassword : {required : "This field is required", equalTo: "Please enter same password" },
			mobile : { required : "This field is required", digits : "Please enter numbers only" },
			role : { required : "This field is required", selected : "Please select atleast one option" },
			institution : { required : "This field is required" },
			department : { required : "This field is required" },
			country : { required : "This field is required" },
			city : { required : "This field is required" },
			orcid_id : { required : "This field is required" },
			expertise_area : { required : "This field is required" }
		}
	});
});
