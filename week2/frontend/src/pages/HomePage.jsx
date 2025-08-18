import React, { useState } from 'react'
import NavBar from '../components/NavBar'
import RateLimitedUI from '../components/RateLimitedUI'
import { useEffect } from 'react'
import api from '../lib/anxios'
import {toast} from "react-hot-toast"

const HomePage = () => {
    const [israteLimted, setIsRateLimited] = useState(false)
    const [isNote, setisNote] = useState([])
    const [loading, setLoading] = useState(true)


    useEffect(() => {
        const fetchNote = async () => {
            try {
                const res = await api.get("/note", { withCredentials: true })
                console.log(res.data)
                setisNote(res.data.length > 0)
                setIsRateLimited(false)
            } catch (error) {
                console.error("에러 발생:", error)
                if (error.response.status === 429) {
                    setIsRateLimited(true)
                }
                else {
                    toast.error("Failed to load notes")
                }
            }
            finally {
                setLoading(false)
            }
        }
        fetchNote()
    }, [])
  return (
    <div className='min-h-screen'>
          <NavBar />
          {israteLimted && <RateLimitedUI />}
    </div>
  )
}

export default HomePage
