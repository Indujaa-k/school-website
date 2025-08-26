import express from "express";
import nodemailer from "nodemailer";
import bodyParser from "body-parser";
import cors from "cors";

const app = express();
app.use(cors());
app.use(bodyParser.json());

// POST route to handle enquiry form
app.post("/send-enquiry", async (req, res) => {
  const { name, mobile, email, className, message } = req.body;

  try {
    // Create transporter
    const transporter = nodemailer.createTransport({
      service: "gmail", // can use other services
      auth: {
        user: "indhujaakddeveloper@gmail.com",       // your email
        pass: "bqip rsgx bxqa fxik"          // Gmail App Password
      }
    });

    // Email content
    const mailOptions = {
      from: email,                         // sender
      to: "indhujaakddeveloper@gmail.com",           // your receiving email
      subject: "New School Enquiry",
      html: `
        <h3>New Enquiry Received</h3>
        <p><b>Name:</b> ${name}</p>
        <p><b>Mobile:</b> ${mobile}</p>
        <p><b>Email:</b> ${email}</p>
        <p><b>Class:</b> ${className}</p>
        <p><b>Message:</b> ${message}</p>
      `
    };

    // Send email
    await transporter.sendMail(mailOptions);

    res.status(200).json({ success: true, message: "Enquiry sent successfully!" });
  } catch (err) {
    console.error(err);
    res.status(500).json({ success: false, message: "Failed to send enquiry." });
  }
});

app.listen(5000, () => console.log("Server running on http://localhost:5000"));
