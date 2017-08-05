$(document).ready(function(){
        $('#registrationForm').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'The username is required'
                        },
                        stringLength: {
                            min: 3,
                            max: 30,
                            message: 'The username must be more than 6 and less than 30 characters long'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: 'The username can only consist of alphabetical, number, dot and underscore'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email address is required'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required'
                        },
                        different: {
                            field: 'username',
                            message: 'The password cannot be the same as username'
                        }
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: 'The phone is required'
                        },
                        regexp: {
                            //regexp: /^\d{11}$/,
                            regexp: "^[0-9]{10,11}$",
                            message: 'The phone can only consist of number and must be more than 10'
                        }
                    }
                },
                gender: {
                    validators: {
                        notEmpty: {
                            message: 'The gender is required'
                        }
                    }
                },
                birthday: {
                    validators: {
                        notEmpty: {
                            message: 'The date of birth is required'
                        },
                        date: {
                            format: 'YYYY/MM/DD',
                            message: 'The date of birth is not valid'
                        }
                    }
                },
                time_start: {
                    validators: {
                        notEmpty: {
                            message: 'The time_start is required'
                        },
                    }
                },
                time_end: {
                    validators: {
                        notEmpty: {
                            message: 'The time_end is required'
                        },
                    }
                },
            }
        });
    });