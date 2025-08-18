import express from "express";
import dotenv from "dotenv";
import cors from "cors";
import path from "path";

dotenv.config({ path: ".env" });

import nodesRouter from "./routes/nodeRoutes.js";
import { connectDB } from "./config/db.js";
import rateLimiter from "./middleware/rateLimiter.js";

const app = express();
const PORT = process.env.PORT || 8777;
const __dirname = path.resolve();

// CORS 미들웨어 설정
app.use(
  cors({
    origin: "http://localhost:5173", // 프론트엔드 주소
    credentials: true,
  })
);

app.use(express.json());
app.use(rateLimiter);
app.use("/api/note", nodesRouter);
app.use(express.static(path.join(__dirname, "../frontend/dist")));

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
