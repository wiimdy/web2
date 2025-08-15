import React, { useState } from 'react'
import NavBar from '../components/NavBar'
import RateLimitedUI from '../components/RateLimitedUI'
import { useEffect } from 'react'
import axios from "axios"

const HomePage = () => {
    const [israteLimted, setIsRateLimited] = useState(false)
    const [isNote, setisNote] = useState(true)

    useEffect(() => {
        const fetchNote = async () => {
            try {
                const res = await axios.get("http://localhost:8777/api/note")
                const data = await res.json()
                console.log(data )
            } catch (error) {
                
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
