function signupformonoff() {
  const signupform = document.getElementById("signupform");
  if (signupform.style.display == "none") {
    signupform.style.display = "block";
  } else {
    signupform.style.display = "none";
  }
}

function newSignUp() {
  const signUpData = new FormData(document.getElementById("signupform"));
  const jsonSignUp = {};
  signUpData.forEach((value, key) => {
    jsonSignUp[key] = value;
  });
  fetch("/api/signup", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(jsonSignUp),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
    })
    .catch((error) => {
      console.error(error);
    });
}

function userLogIn() {
  const emailaddress = document.getElementById("emailaddress").value;
  const userpassword = document.getElementById("userpassword").value;

  if (!emailaddress || !userpassword) {
    alert("Complete both email and password fields.");
    return;
  }

  const userData = {
    emailaddress: emailaddress,
    userpassword: userpassword,
  };

  fetch("/login", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(userData),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert("Login failed. Check your credentials.");
      }
    })
    .catch((error) => {
      console.error("Error during login:", error);
    });
}
