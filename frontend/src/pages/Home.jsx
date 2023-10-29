import React from 'react'
import { Link } from 'react-router-dom'

function Home() {
  return (
    <div className='flex flex-col justify-center items-center gap-2 my-20'>
    <Link to="/resturents/1">
      <button className='bg-[var(--primary)] rounded-md p-2'>Resturents Editor</button>
      </Link>
      <Link to="/customers/1">
      <button className='bg-[var(--primary)] rounded-md p-2'>Customer Editor</button>
      </Link>
    </div>
  )
}

export default Home
