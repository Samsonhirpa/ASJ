/**
 * File : editUser.js 
 * 
 * This file contain the validation of edit user form
 * 
 * @author Kishor Mali
 */
$(document).ready(function(){
	
	var nameRules = {
		title : { required : true },
		first_name : { required : true },
		middle_name : { required : true },
		last_name : { required : true },
		institution : { required : true },
		department : { required : true },
		country : { required : true },
		city : { required : true },
		orcid_id : { required : true },
		expertise_area : { required : true }
	};

	var nameMessages = {
		title : { required : "This field is required" },
		first_name : { required : "This field is required" },
		middle_name : { required : "This field is required" },
		last_name : { required : "This field is required" },
		institution : { required : "This field is required" },
		department : { required : "This field is required" },
		country : { required : "This field is required" },
		city : { required : "This field is required" },
		orcid_id : { required : "This field is required" },
		expertise_area : { required : "This field is required" }
	};

	var editUserForm = $("#editUser");
	
	var validator = editUserForm.validate({
		
		rules: $.extend({}, nameRules, {
			email : { required : true, email : true, remote : { url : baseURL + "checkEmailExists", type :"post", data : { userId : function(){ return $("#userId").val(); } } } },
			cpassword : {equalTo: "#password"},
			mobile : { required : true, digits : true },
			role : { required : true, selected : true}
		}),
		messages: $.extend({}, nameMessages, {
			email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
			cpassword : {equalTo: "Please enter same password" },
			mobile : { required : "This field is required", digits : "Please enter numbers only" },
			role : { required : "This field is required", selected : "Please select atleast one option" }
		})
	});

	var editProfileForm = $("#editProfile");
	
	var validator = editProfileForm.validate({
		
		rules: $.extend({}, nameRules, {
			mobile : { required : true, digits : true },
			email : { required : true, email : true, remote : { url : baseURL + "checkEmailExists", type :"post", data : { userId : function(){ return $("#userId").val(); } } } },
		}),
		messages: $.extend({}, nameMessages, {
			mobile : { required : "This field is required", digits : "Please enter numbers only" },
			email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
		})
	});

});
