import express from "express";
import dotenv from "dotenv";

dotenv.config({ path: ".env" });

import nodesRouter from "./routes/nodeRoutes.js";
import { connectDB } from "./config/db.js";
import rateLimiter from "./middleware/rateLimiter.js";

const app = express();
const PORT = process.env.PORT || 8777;

app.use(express.json());
app.use(rateLimiter);
app.use("/api/note", nodesRouter);

app.get("/", (req, res) => {
  res.status(200).send("HelW ddd ddorld");
});

connectDB().then(() => {
  app.listen(PORT, () => {
    console.log(
      "Server is running on port: ",
      PORT,
      "\n" + "http://localhost:8777"
    );
  });
});
