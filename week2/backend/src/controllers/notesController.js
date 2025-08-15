import Note from "../models/Note.js";

export async function getAllnotes(_, res) {
  try {
    const notes = await Note.find().sort({ createdAt: -1 }); // newest first
    res.status(200).json(notes);
  } catch (error) {
    console.error("Error in getallnotes", error);
    res.status(500).json({ message: "Internal Server Error" });
  }
}

export async function createNote(req, res) {
  try {
    const { title, content } = req.body;
    const newNote = new Note({ title: title, content: content });

    await newNote.save();
    res.status(201).json({ message: "Note creates" });
  } catch (error) {
    console.error("Error in createNote", error);
    res.status(500).json({ message: "Internal Server Error" });
  }
}

export async function updateNote(req, res) {
  try {
    const { title, content } = req.body;
    const updateNotes = await Note.findByIdAndUpdate(
      req.param.id,
      { title, content },
      { new: true }
    );
    if (!updateNotes) {
      return res.status(404).json({ message: "Notes Not found" });
    }

    res.status(200).json({ message: "Note Update" });
  } catch (error) {
    console.error("Error in createNote", error);
    res.status(500).json({ message: "Internal Server Error" });
  }
}

export async function deleteNote(req, res) {
  try {
    const deleteNote = await Note.findByIdAndDelete(req.param.id);
    if (!deleteNote) {
      return res.status(404).json({ message: "Notes Not found" });
    }
    res.status(200).json({ message: "Note Delete" });
  } catch (error) {
    console.error("Error in createNote", error);
    res.status(500).json({ message: "Internal Server Error" });
  }
}
export async function getNoteById(req, res) {
  try {
    const findNote = await Note.findById(req.param.id);
    if (!findNote) return res.status(404).json({ message: "Not found" });

    res.status(200).json(findNote);
  } catch (error) {
    console.error("Error in createNote", error);
    res.status(500).json({ message: "Internal Server Error" });
  }
}
