/**
 *  JavaScripts that are used by 
 */
	$(document).ready(function() {
		
		//Script for validation registration form
		$("#studentform").validate({
			rules: {
				users_Name: {
					required:true,
                                        
                                        accept:"[a-zA-ZšđžčćŠĐŽČĆABCÇDEFGHIJKLMNÑOPQRSTUVWXYZabcçdefghijklmnñopqrstuvwxyzàáÀÁéèÈÉíìÍÌïÏóòÓÒúùÚÙüÜ]+"
                                        
                                        
				},
				users_Surname: {
					required:true,
                                         accept:"[a-zA-ZšđžčćŠĐŽČĆABCÇDEFGHIJKLMNÑOPQRSTUVWXYZabcçdefghijklmnñopqrstuvwxyzàáÀÁéèÈÉíìÍÌïÏóòÓÒúùÚÙüÜ]+"
				},
				users_City: {
					required:true,
                                         accept:"[a-zA-ZšđžčćŠĐŽČĆABCÇDEFGHIJKLMNÑOPQRSTUVWXYZabcçdefghijklmnñopqrstuvwxyzàáÀÁéèÈÉíìÍÌïÏóòÓÒúùÚÙüÜ]+"
				},
				users_Country: {
					required:true,
                                         accept:"[a-zA-ZšđžčćŠĐŽČĆABCÇDEFGHIJKLMNÑOPQRSTUVWXYZabcçdefghijklmnñopqrstuvwxyzàáÀÁéèÈÉíìÍÌïÏóòÓÒúùÚÙüÜ]+",
                                         remote: {url: "countries.php",
                                             type:"post"
                                             
                                         }

				},
				users_Username: {
					required:true,
					minlength:6,
					maxlength:20,
                                         remote: {url: "neki.php",
                                             type:"post"

                                         }

				},
				users_Password: {
					required:true,
					minlength:6,
					maxlength:20
				},
				users_Password1: {
					required:true,
					
					equalTo: "#users_Password"
				},
				users_Email: {
					required: true,
					email: true,
                                        remote: {url: "neki.php",
                                             type:"post"

                                         }

				},
                                captcha:{
                                    required: true
                                }
			},
			messages: {
				users_Name: {
					required: "Required",
                                        accept: "Numbers are not allowed and name must be more that 2 characters"
				},
				users_Surname: {
					required: "Required",
                                         accept: "Numbers are not allowed and surname must be more that 2 characters"
				},
				users_City: {
					required: "Required",
                                         accept: "Numbers are not allowed and city name must be more that 2 characters"
				},
				users_Country: {
					required: "Required",
                                         accept: "Numbers are not allowed and country name must be more that 2 characters",
                                         remote: "Please pick a country from a drop down list"
                                         
				},
				users_Username: {
					required: "Required!",
					minlength: "Minimum 6 characters!",
					maxlength: "Maximum 20 characters!",
                                        remote: "Username is taken or it is invalid. Only A-Z, a-z and 0-9 are allowed"
				},	
				users_Password: {
					required: "Required!",
					minlength: "Minimum 6 characters!",
					maxlength: "Maximum 20 characters!"
				},									
				users_Password1: {
					required: "Required!",
					
					equalTo: "Passwords are not equal!"
				},														
				users_Email: {email: "Email must be valid!",
                                remote: "Email is already in use"
                                }
			}

		});
		
		//Script for validation COMPANY registration form
		$("#companyform").validate({
			rules: {
				cm_Name: {
					required:true,
                                        accept:"[a-zA-Z]+"
				},
				cm_Address: {
					required:true
				},
				cm_City: {
					required:true,
                                        accept:"[a-zA-Z]+"
				},
				cm_Country: {
					required:true,
                                        accept:"[a-zA-Z]+",
                                        remote: {url: "countries.php",
                                             type:"post"
                                             
                                         }
				},
				cm_Username: {
					required:true,
					minlength:6,
					maxlength:20,
                                        remote: {url: "neki.php",
                                             type:"post"

                                         }

				},
				cm_Password: {
					required:true,
					minlength:6,
					maxlength:20
				},
				cm_Password1: {
					required:true,
					
					equalTo: "#cm_Password"
				},
				cm_Login_email: {
					required: true,
					email: true,
                                        remote: {url: "neki.php",
                                             type:"post"

                                         }

				},
                                captcha:{
                                    required: true
                                }
			},
			messages: {
				cm_Name: {
					required: "Required",
                                         accept: "Numbers are not allowed and name must be more that 2 characters"
				},
				cm_Address: {
					required: "Required"
				},
				cm_City: {
					required: "Required",
                                         accept: "Numbers are not allowed and name must be more that 2 characters"
				},
				cm_Country: {
					required: "Required",
                                         accept: "Numbers are not allowed and country name must be more that 2 characters",
                                        remote: "Please pick a country from a drop down list"
				},
				cm_Username: {
					required: "Required!",
					minlength: "Minimum 6 characters!",
					maxlength: "Maximum 20 characters!",
                                        remote: "Username is taken or it is invalid. Only A-Z, a-z and 0-9 are allowed"
				},	
				cm_Password: {
					required: "Required!",
					minlength: "Minimum 6 characters!",
					maxlength: "Maximum 20 characters!"
				},									
				cm_Password1: {
					required: "Required!",
					
					equalTo: "Passwords are not equal!"
				},														
				cm_Login_email: {email:"Email must be valid!",
                                    remote: "Email is already in use"
                                }
			}

		});	
		
		
		//Script for validation University registration form
		$("#universityform").validate({
			rules: {
				un_Name_of_University: {
					required:true
				},
				un_Name_of_Faculty: {
					required:true
				},
				un_Address: {
					required:true
				},
				un_City: {
					required:true,
                                        accept:"[a-zA-Z]+"
				},
				un_Country: {
					required:true,
                                        accept:"[a-zA-Z]+",
                                         remote: {url: "countries.php",
                                             type:"post"
                                             
                                         }
				},
				un_Username: {
					required:true,
					minlength:6,
					maxlength:20,
                                        remote: {url: "neki.php",
                                             type:"post"

                                         }

				},
				un_Password: {
					required:true,
					minlength:6,
					maxlength:20
				},
				un_Password1: {
					required:true,
					
					equalTo: "#un_Password"
				},
				un_Login_email: {
					required: true,
					email: true,
                                        remote: {url: "neki.php",
                                             type:"post"

                                         }

				},
                                captcha:{
                                    required: true
                                }
			},
			messages: {
				un_Name_of_University: {
					required: "Required"
				},
				un_Name_of_Faculty: {
					required: "Required"
				},
				un_Address: {
					required: "Required"
				},
				un_City: {
					required: "Required",
                                        accept: "Numbers are not allowed"
				},
				un_Country: {
					required: "Required",
                                        accept: "Numbers are not allowed and country name must be more that 2 characters",
                                        remote: "Please pick a country from a drop down list"
				},
				un_Username: {
					required: "Required!",
					minlength: "Minimum 6 characters!",
					maxlength: "Maximum 20 characters!",
                                        remote: "Username is taken or it is invalid. Only A-Z, a-z and 0-9 are allowed"
				},	
				un_Password: {
					required: "Required!",
					minlength: "Minimum 6 characters!",
					maxlength: "Maximum 20 characters!"
				},									
				un_Password1: {
					required: "Required!",
					minlength: "Minimum 6 characters!",
					maxlength: "Maximum 20 characters!",
					equalTo: "Passwords are not equal!"
				},														
				un_Login_email: {email: "Email must be valid!",
                                    remote: "Email is already in use"
                                }
			}

		});	
		
		//Script for validation University registration form
		$("#passwordchangeform").validate({
			rules: {
				old_password: {
					required:true,
					minlength:6,
					maxlength:20
				},
				new_password: {
					required:true,
					minlength:6,
					maxlength:20
				},
				new_password1: {
					required:true,
					minlength:6,
					maxlength:20,
					equalTo: "#new_password"
				}
			},
			messages: {
				old_password: {
					required: "Required!",
					minlength: "Minimum 6 characters!",
					maxlength: "Maximum 20 characters!"
				},
				new_password: {
					required: "Required!",
					minlength: "Minimum 6 characters!",
					maxlength: "Maximum 20 characters!"
				},									
				new_password1: {
					required: "Required!",
					minlength: "Minimum 6 characters!",
					maxlength: "Maximum 20 characters!",
					equalTo: "Passwords are not equal!"
				}												
			}
		});


                $("#avatarform").validate({
			rules: {
				avatar_image: {
					required:true
				}
                               
			},
			messages: {
				avatar_image: {
					required: "Required!"
				}
                                
			}
		});
                 $("#form").validate({
			rules: {
				xml_cv: {
					required:true
				},
                                stud_cv_Name:{
                                    required:true
                                },
                                 stud_cv_Surname:{
                                    required:true
                                },
                                 stud_cv_Country:{
                                    required:true
                                },
                                 stud_cv_City:{
                                    required:true
                                },
                                 
                                 stud_cv_Name:{
                                    required:true
                                },
                                stud_cv_Date_of_birth:{
                                    required:true,
                                    dateISO: true
                                },
                                stud_cv_Email:{
                                    required:true,
                                    email:true
                                }
			},
			messages: {
				xml_cv: {
					required: "Required!"
				},
                                stud_cv_Date_of_birth:{
                                    dateISO: "Enter valid date format (YYYY-MM-DD"
                                }
			}
		});
                $("#form_article").validate({
			rules: {
				article_title: {
					required:true
				}
                                
			},
			messages: {
				
			}
		});
               $("#form_message").validate({
			rules: {
				messages_send_to:{
                                  required:true
                                },
				messages_headline:{
					required:true
				},
				messages_msg:{
					required:true
				}

			},
			messages: {


			}
		});
                $("#forgotpassword").validate({
			rules: {
				username: {
					required:true
				},
                                mail:{
                                    required:true
                                }
			},
			messages: {
				username: {
					required: "Required!"
				},
                                mail:{
                                    required:"Required!"
                                }
			}
		});

                 $("#bug_form").validate({
			rules: {
				bug_title: {
					required:true
				},
                                bug_description:{
                                    required:true
                                },
                                bug_when:{
                                    required:true
                                }
			}

		});

                $("#companyeditform").validate({
			rules: {
				cm_Field_of_work: {
					required:true
				},
                                cm_Contact_person:{
                                    required:true
                                },
                                cm_City:{
                                    required:true
                                },
                                cm_Country:{
                                    required:true
                                },
                                cm_Email:{
                                    required:true,
                                    email: true
                                }

			},
			messages: {
				
			}
		});
		
	});

