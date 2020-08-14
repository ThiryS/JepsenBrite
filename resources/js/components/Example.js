import ReactDOM from "react-dom";

import React, { useState } from "react";
import MultiSelect from "react-multi-select-component";

const Example = props => {
    const categories = JSON.parse(props.categories);
    const passedcategory = props.selectedcategory === null? categories[0].id : props.selectedcategory;
    const passedsubcategories = props.selectedsubcategories === null? [] : JSON.parse(props.selectedsubcategories).map(item => ({
        value: item.id,
        label: item.name
    }));
    const [selectedCategory, setSelectedCategory] = useState(passedcategory);
    const [selected, setSelected] = useState(passedsubcategories);
    console.log(selected);
    const options = categories
        .find(item => item.id === Number(selectedCategory))
        .subcategories.map(item => ({
            value: item.id,
            label: item.name
        }));
    
    
    const handleChange = e => {
        setSelected([]);
        setSelectedCategory(e.target.value);
    };
    return (
        <div>
            <div className="form-group row">
                <label className="col-md-4 col-form-label text-md-right">
                    Categorie
                </label>

                <div className="col-md-6">
                    <select
                        value={selectedCategory}
                        name="category_id"
                        onChange={handleChange}
                    >
                        {categories.map(item => (
                            <option value={item.id}>{item.name}</option>
                        ))}
                    </select>
                </div>
            </div>
            <div className="form-group row">
                <label className="col-md-4 col-form-label text-md-right">
                    Sous Catégorie
                </label>

                <div className="col-md-6">
                    <input type="hidden" name="subcategory_ids" value={selected.map(item => item.value)}></input>
                    <MultiSelect
                        options={options}
                        value={selected}
                        onChange={setSelected}
                        labelledBy={"Select"}
                    />
                </div>
            </div>
        </div>
    );
};
Example.defaultProps = {selectedcategory:null, selectedsubcategories:null };
export default Example;

if (document.getElementById("multiselect")) {
    // create new props object with element's data-attributes
    // result: {tsId: "1241"}
    const element = document.getElementById("multiselect");
    const props = Object.assign({}, element.dataset);

    // render element with props (using spread)
    ReactDOM.render(<Example {...props} />, element);
}
