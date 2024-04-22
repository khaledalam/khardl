import EditorSlider from "../../../pages/EditorsPage/Restuarants/components/EditorSlider";
import ProductItem from "../../../pages/EditorsPage/Restuarants/components/ProductItem";

const Category = ({ restaurantStyle, categories }) => {
    const {
        price_color,
        text_color,
        text_alignment,
        text_fontWeight,
        categoryDetail_shape,
        text_fontSize,
        categoryDetail_cart_color,
        menu_category_position,
        menu_section_background_color,
        menu_section_radius,
    } = restaurantStyle;

    const scrollToSection = (sectionId) => {
        const section = document.getElementById(sectionId);
        if (section) {
            section.scrollIntoView({ behavior: "smooth" });
        }
    };

    return (
        <div
            className={`w-full h-full flex ${
                menu_category_position === "center"
                    ? "flex-col justify-center items-center"
                    : "flex-row items-start"
            }  gap-[16px]`}
        >
            <div
                className={`h-full overflow-x-hidden overflow-y-scroll hide-scroll ${
                    menu_category_position === "left"
                        ? "order-1 w-[33%]"
                        : menu_category_position === "right"
                        ? "order-2 w-[33%]"
                        : menu_category_position === "center"
                        ? "w-full"
                        : "w-[33%]"
                } `}
            >
                <EditorSlider
                    items={categories}
                    scrollToSection={scrollToSection}
                    isHighlighted={false}
                    currentSubItem={null}
                />
            </div>
            <div
                style={{
                    backgroundColor: menu_section_background_color,
                    borderRadius: `${menu_section_radius}px`,
                }}
                className={`h-full  ${
                    menu_category_position === "left"
                        ? "order-2 w-[75%]"
                        : menu_category_position === "right"
                        ? "order-1 w-[75%]"
                        : menu_category_position === "center"
                        ? "w-full max-w-[710px]"
                        : "w-[75%]"
                } py-[32]
                `}
            >
                <div
                    className={`w-full h-full flex flex-col max-h-[610px] items-start justify-center `}
                >
                    <div
                        className={`flex flex-col gap-[30px] h-fit p-4 overflow-y-scroll hide-scroll`}
                    >
                        {categories &&
                            categories.map((category, i) => (
                                <div
                                    className="flex flex-col"
                                    key={i}
                                    id={category.name}
                                >
                                    <div className="text-black text-opacity-75 text-lg font-medium mb-[16px]">
                                        {category.name}
                                    </div>
                                    <div className="flex flex-row flex-wrap gap-[25px] justify-center">
                                        {category.items.map((product, idx) => (
                                            <ProductItem
                                                key={idx + "prdt"}
                                                id={product.id}
                                                name={product.name}
                                                imgSrc={product.photo}
                                                amount={product.price}
                                                description={
                                                    product.description
                                                }
                                                caloryInfo={product.calories}
                                                checkbox_required={
                                                    product?.checkbox_required ?? [
                                                        "true",
                                                        "false",
                                                    ]
                                                }
                                                checkbox_input_titles={
                                                    product?.checkbox_input_titles ?? [
                                                        [],
                                                    ]
                                                }
                                                checkbox_input_names={
                                                    product?.checkbox_input_names ?? [
                                                        [],
                                                    ]
                                                }
                                                checkbox_input_prices={
                                                    product?.checkbox_input_prices ?? [
                                                        [],
                                                    ]
                                                }
                                                selection_required={
                                                    product?.selection_required ?? [
                                                        "true",
                                                        "false",
                                                    ]
                                                }
                                                selection_input_titles={
                                                    product?.selection_input_titles ?? [
                                                        [],
                                                    ]
                                                }
                                                selection_input_names={
                                                    product?.selection_input_names ?? [
                                                        [],
                                                    ]
                                                }
                                                selection_input_prices={
                                                    product?.selection_input_prices ?? [
                                                        [],
                                                    ]
                                                }
                                                dropdown_required={
                                                    product?.dropdown_required ?? [
                                                        "true",
                                                        "false",
                                                    ]
                                                }
                                                dropdown_input_prices={
                                                    product?.dropdown_input_prices ?? [
                                                        [],
                                                    ]
                                                }
                                                dropdown_input_titles={
                                                    product?.dropdown_input_titles ?? [
                                                        [],
                                                    ]
                                                }
                                                dropdown_input_names={
                                                    product?.dropdown_input_names ?? [
                                                        [],
                                                    ]
                                                }
                                                cartBgcolor={
                                                    categoryDetail_cart_color
                                                }
                                                amountColor={price_color}
                                                textColor={text_color}
                                                textAlign={text_alignment}
                                                fontWeight={text_fontWeight}
                                                shape={categoryDetail_shape}
                                                fontSize={text_fontSize}
                                                currentSubItem={null}
                                            />
                                        ))}
                                    </div>
                                </div>
                            ))}
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Category;
