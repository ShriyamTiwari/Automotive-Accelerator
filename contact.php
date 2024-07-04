<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
       
        .navbar {
      background-color: #0c1445;
      overflow: hidden;
      position: fixed;
      top: 0;
      width: 100%;
      height: 80px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
   .navbar a {
      float: left;
      display: block;
      color: white;
      text-align: center;
      padding: 24px 16px;
      text-decoration: none;
      font-size: 18px;
      font-weight: bold;
    }
   .navbar a:hover {
      background-color: #ddd;
      color: black;
    }

        body {
            background-image: url('contact3.jpeg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            height: 100vh; /* Full viewport height */
        }

        .container {
            width: 70%;
            max-width: 400px; /* Added max-width for responsiveness */
            background-color:#0c1445;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 50px; 
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
            color: #333;
            color: whitesmoke;
        }

        p {
            color: whitesmoke;
            margin-bottom: 20px;
        }

        label {
            display: inline-block;
            width: 100px;
            margin-bottom: 5px;
            color: whitesmoke;
            text-align: left;
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: calc(100% - 120px);
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
            box-sizing: border-box; /* Added box-sizing to include padding in width calculation */
        }

        select {
            width: calc(100% - 120px);
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        #message {
            width: calc(100% - 120px); /* Adjust width */
            margin-bottom: 15px; /* Adjust margin */
        }
    </style>
</head>
<body >
    
<div class="navbar">
    <a href="home.html">Home</a>
    <a href="contact.php">Contact</a>
    <a href="profile.php">Profile</a>
  </div>
    <div class="container">
        <h2>Contact Us</h2>
        <p>Please fill out the form below to get in touch.</p>
        <form id="contactForm">
            <label for="name">&nbsp;&nbsp;&nbsp;Name</label><br>
            <input type="text" id="name" name="name" required><br>

            <label for="email">&nbsp;&nbsp;&nbsp;Email</label><br>
            <input type="email" id="email" name="email" required><br>

            <label for="subject">&nbsp;&nbsp;&nbsp;Subject</label><br>
            <select id="subject" name="subject">
                <option value="General Inquiry">General Inquiry</option>
                <option value="Feedback">Feedback</option>
                <option value="Support">Support</option>
                <option value="Other">Other</option>
            </select><br>

            <label for="message">&nbsp;&nbsp;&nbsp;Message</label><br>
            <textarea id="message" name="message" rows="5" required></textarea><br>

            <button type="submit">Send</button>
        </form>
    </div>

    <script>
        const form = document.getElementById('contactForm');

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;

            console.log(`Name: ${name}`);
            console.log(`Email: ${email}`);
            console.log(`Subject: ${subject}`);
            console.log(`Message: ${message}`);

            // Clear form fields after submission
            document.getElementById('name').value = '';
            document.getElementById('email').value = '';
            document.getElementById('subject').value = 'General Inquiry'; // Reset subject to default
            document.getElementById('message').value = '';
        });
    </script>
    
</body>
</html>
