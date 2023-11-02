import React from 'react'
import { setLogo, clearLogo } from '../../../../redux/editor/logoSlice';
import { useSelector, useDispatch } from 'react-redux';
import { BiImageAdd } from 'react-icons/bi';
import { AiOutlineClose } from 'react-icons/ai';

function Logo() {
    const dispatch = useDispatch();
    const logo = useSelector(state => state.logo);
    const shapeImageType = useSelector(state => state.shapeImage.shapeImageShape);
    const handleImageChange = event => {
        const selectedImage = event.target.files[0];

        if (selectedImage) {
            dispatch(setLogo(URL.createObjectURL(selectedImage)));
        }
    };
    const handleRemoveImage = () => {
        dispatch(clearLogo());
    };
    return (
        <div className='me-4'>
            {logo ? (
                <div className="relative w-[80px] h-[80px] rounded-md bg-center bg-cover shadow-md">
                    <button
                        className="absolute top-[-10px]  shadow-[0_-1px_8px_rgba(0,0,0,0.1)] right-[-10px] bg-white text-black w-fit h-fit p-2 rounded-full hover:bg-red-400 hover:text-white "
                        onClick={handleRemoveImage}
                    >
                        <AiOutlineClose size={10} />
                    </button>
                    <div
                        data-tooltip-target="tooltip-light" data-tooltip-style="light"
                        className={`w-[80px] h-[80px] rounded-md bg-center bg-cover`}
                        style={{ backgroundImage: `url(${logo})`, color: '#fff', borderRadius: shapeImageType }}
                    >
                    </div>
                </div>
            ) : (
                <>
                    <input type='file' accept='image/*' id='logo' onChange={handleImageChange} className='hidden' />
                    <label
                        data-tooltip-target="tooltip-light" data-tooltip-style="light"
                        htmlFor='logo'
                        className={`w-[80px] h-[80px] bg-slate-600 hover:bg-slate-800 text-white shadow-md flex flex-col items-center justify-center cursor-pointer`}
                        style={{ borderRadius: shapeImageType }}
                    >
                        <BiImageAdd size={30} />
                    </label>
                </>
            )}
        </div>
    )
}

export default Logo
