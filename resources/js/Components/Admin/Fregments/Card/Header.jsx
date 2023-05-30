export default function Header(props) {
    return (
        <div className="card__header mb-0">
            <div className="card__header-left">
                {props.children}
            </div>
        </div>
    )
}