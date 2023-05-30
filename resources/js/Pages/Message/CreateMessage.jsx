import Card from "@/Components/Admin/Fregments/Card";
import FGInput from "@/Components/Admin/Fregments/Input";
import { useForm } from "@inertiajs/react";
import classNames from "classnames";

export default function CreateMessage(props) {
    const { data, setData, post, processing, errors } = useForm({
        title: '',
        content: '',
    })

    const handleOnSubmit = (e) => {
        e.preventDefault()
        console.log(route("login"))
        // post(route("your_route_name", { key: value }).url())
    }

    return (
        <div className="row">
            <div className="col-7">
                <form onSubmit={handleOnSubmit}>
                    <Card>
                        <Card.Body>
                            <div className="form">
                                <div className="form__row">
                                    <FGInput 
                                        label="Title" 
                                        value={data.title}
                                        onChange={e => setData('email', e.target.value)}
                                        error={errors.title}
                                    />
                                </div>
                                <div className="form__row">
                                    <FGInput 
                                        label="Content" 
                                        value={data.content} 
                                        onChange={e => setData('email', e.target.value)}
                                        error={errors.content}
                                    />
                                </div>
                            </div>
                            <button type="submit" disabled={processing} className={classNames('btn btn-primary', {'disabled': processing })}>
                                Login
                            </button>
                        </Card.Body>
                    </Card>
                </form>
            </div>
        </div>
    )
}