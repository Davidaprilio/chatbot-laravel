import { Button, Menu, MenuButton, MenuList } from "@chakra-ui/react"
import { useRef } from "react"

export default function ContextMenu(props) {
    const menu = useRef()

    if (props.position) {
        if ((props.position.x + menu.current.offsetWidth) >= window.innerWidth) props.position.x -= (menu.current.offsetWidth + 10)
        if ((props.position.y + menu.current.offsetHeight) >= window.innerHeight) props.position.y -= (menu.current.offsetHeight + 10)
    }

    return (
        <Menu {...props} isOpen={props.position} >
            {({ isOpen }) => (
                <>
                    <MenuButton style={{ display: 'none' }} isActive={isOpen} as={Button}></MenuButton>
                    <MenuList ref={menu} className={props.position ? 'ctx-visible' : 'ctx-hidden'} style={{
                        position: 'fixed',
                        zIndex: 9999,
                        top: props.position?.y,
                        left: props.position?.x
                    }}>
                        {props.children}
                    </MenuList>
                </>
            )}
        </Menu>
    )
};


