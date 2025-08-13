import express from "express";

const app = express();

app.get("/", (req, res) => {
  res.status(200).send("HelW  ddorld");
});

app.listen(8777, () => {
  console.log("Server is running on port 8777, \n" + "http://localhost:8777");
});
