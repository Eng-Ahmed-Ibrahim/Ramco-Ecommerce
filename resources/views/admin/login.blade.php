  <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
      <link rel="icon" href="{{ asset('images/logo.png') }}">

  <style>
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");
* {
  padding: 0%;
  margin: 0%;
  box-sizing: border-box;
  border: none;
  outline: none;
}
body {
  height: 100vh;
  background-color: #080710;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}
.background {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  height: 530px;
  width: 430px;
}
.background .shapes {
  position: absolute;
  height: 200px;
  width: 200px;
  border-radius: 50%;
}
.shapes:nth-child(1) {
  top: -50px;
  right: -50px;
  background: rgb(131, 58, 180);
  background: rgb(0, 255, 59);
  background: linear-gradient(
    90deg,
    rgba(0, 255, 59, 1) 0%,
    rgba(0, 18, 255, 1) 100%,
    rgba(252, 176, 69, 1) 100%
  );
}
.shapes:nth-child(2) {
  bottom: -50px;
  left: -50px;
  background: rgb(255, 0, 0);
  background: linear-gradient(
    90deg,
    rgba(255, 0, 0, 1) 0%,
    rgba(188, 0, 255, 1) 100%,
    rgba(252, 176, 69, 1) 100%
  );
}
form {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  height: 460px;
  width: 340px;
  z-index: 5;
  padding: 20px;
  overflow: hidden;
  background: rgba(250, 250, 250, 0.15);
  box-shadow: 1px 1px 15px 1px rgba(0, 0, 0, 0.15);
  backdrop-filter: blur(4px);
  -webkit-backdrop-filter: blur(4px);
  border-radius: 10px 50px;
  border: 1px solid rgba(255, 255, 255, 0.05);
}
form h3 {
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  color: rgb(255, 255, 255);
  padding: 10px 0px;
  font-size: 2rem;
  text-align: center;
}
form label {
  display: block;
  padding: 20px 0px 10px 0px;
  font-size: 1.2rem;
  color: #ffffff;
}
form input[type="email"],
input[type="password"] {
  display: block;
  position: relative;
  height: 40px;
  width: 100%;
  padding: 10px;
  border: none;
  border-radius: 5px;
  background-color: #ffffff0b;
  color: #ffffffdb;
  font-size: 1rem;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
    Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  cursor: pointer;
  transition: all 450ms;
}
form input[type="email"]:hover,
input[type="password"]:hover {
  background-color: #ffffff10;
}
form input::placeholder {
  font-size: 14px;
  color: #ffffffdb;
}

form button {
  height: 40px;
  width: 100%;
  margin: 40px 0px;
  border-radius: 25px;
  font-weight: 700;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  font-size: 1.2rem;
  color: #000000c3;
  cursor: pointer;
  transition: all 450ms;
}
form button:hover {
  background-color: #ffffffc2;
}
form .social {
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  gap: 10px;
}
.social .gg,
.fb {
  width: 140px;
  padding: 5px;
  background-color: #00000023;
  color: #ffffff;
  text-align: center;
  border-radius: 5px;
  cursor: pointer;
  transition: all 450ms;
}
.social .gg:hover,
.fb:hover {
  background-color: #00000036;
}

  </style>
</head>

<body>
  <div class="background">
    <div class="shapes"></div>
    <div class="shapes"></div>
  </div>
  <form action="{{ route('admin.login.submit') }}" method="POST">
    @csrf
    <h3>Welcome Back</h3>
    <label for="user"> Email</label>
    <input type="email" required name="email" id="user" placeholder="Enter Username" autocomplete="name" />
    <label for="psw">Password</label>
    <input type="password"  required name="password" id="psw" placeholder="Enter Password" autocomplete="password" />
    <button>Login </button>

  </form>
</body>

</html>