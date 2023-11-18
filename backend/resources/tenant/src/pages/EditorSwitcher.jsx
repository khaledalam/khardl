import React, { useEffect } from 'react'
import { Link } from 'react-router-dom'

function EditorSwitcher() {

    useEffect(() => {

    }, []);

   return (
      <div className='flex flex-col justify-center items-center gap-2 my-20'>
          <h2>Choose Site Editor:</h2>
         <Link to='/site-editor/restaurants'>
            <button className='bg-[var(--primary)] rounded-md p-2'>
               Restaurants Editor
            </button>
         </Link>
         <Link to='/site-editor/customers/'>
            <button className='bg-[var(--primary)] rounded-md p-2'>
               Customer Editor
            </button>
         </Link>
      </div>
   )
}

export default EditorSwitcher
