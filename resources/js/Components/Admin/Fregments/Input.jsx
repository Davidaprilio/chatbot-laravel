import classNames from "classnames";
import Input from "../Elements/Input";
import Label from "../Elements/Label";

/**
 * 
 * @param {<{
 * size: 'sm' | 'md' | 'lg' | 'xl' | null,
 * label: string | null
 * }>} props
 * @returns 
 */
export default function FGInput({size = null, label = null, ...props}) {
    return (
        <div className={classNames({
            'form-group': true,
            [`form-group--${size}`]: size
        })}>
            {label && <Label>{label}</Label>}
            <Input {...props} />
        </div>
    )
}