function valid() {
  if (document.chngpwd.password.value == '') {
    alert('Current Password Filed is Empty !!');
    document.chngpwd.password.focus();
    return false;
  } else if (document.chngpwd.newpassword.value == '') {
    alert('New Password Filed is Empty !!');
    document.chngpwd.newpassword.focus();
    return false;
  } else if (document.chngpwd.confirmpassword.value == '') {
    alert('Confirm Password Filed is Empty !!');
    document.chngpwd.confirmpassword.focus();
    return false;
  } else if (
    document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value
  ) {
    alert('Password and Confirm Password Field do not match  !!');
    document.chngpwd.confirmpassword.focus();
    return false;
  }
  return true;
}
