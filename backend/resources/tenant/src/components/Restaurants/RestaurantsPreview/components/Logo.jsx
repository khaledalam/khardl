import React from 'react'
import { setLogo } from '../../../../redux/editor/logoSlice';
import { useSelector, useDispatch } from 'react-redux';
import { BsFillImageFill } from 'react-icons/bs';

function Logo(pros) {

    const { url } = pros;

    const dispatch = useDispatch();
    const shapeImageShape = sessionStorage.getItem('shapeImageShape');
    const logo = url || sessionStorage.getItem('logo');

    const handleImageChange = event => {
        const selectedImage = event.target.files[0];

        if (selectedImage) {
            dispatch(setLogo(URL.createObjectURL( selectedImage)));
        }
    };


    return (
        <div className='me-4'>
            {logo ? (
                <div
                    data-tooltip-target="tooltip-light" data-tooltip-style="light"
                    className={`relative w-[80px] h-[80px] rounded-md bg-center bg-cover bg-slate-600`}
                    style={{ backgroundImage: `url(${logo})`, color: '#fff', borderRadius: shapeImageShape }}
                >
                </div>
            ) : (
                    <div
                        className={`w-[80px] h-[80px] bg-slate-800 text-white shadow-md flex flex-col items-center justify-center cursor-pointer`}
                    >
                        <BsFillImageFill size={30} />
                    </div>
            )}
        </div>
    )
}

export default Logo
