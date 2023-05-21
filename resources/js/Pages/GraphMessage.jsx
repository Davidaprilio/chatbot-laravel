import { Button, Menu, MenuButton, MenuItem, MenuList } from '@chakra-ui/react';
import { Head } from '@inertiajs/react';
import { useEffect, useRef, useState } from 'react';

export default function GraphMessage({ auth, laravelVersion, phpVersion }) {

    const [ctxMenuPosition, setCtxMenuPosition] = useState(null)

    const openCtxMenu = (ev) => {
        ev.preventDefault()
        console.log('Apaan tuh', {
            x: ev.clientX,
            y: ev.clientY
        });
        setCtxMenuPosition({
            x: ev.clientX,
            y: ev.clientY
        })
    }
    const closeCtxMenu = () => setCtxMenuPosition(null)

    useEffect(() => {
        window.oncontextmenu = openCtxMenu

        return () => {
            window.oncontextmenu = undefined
        }
    }, [])

    return (
        <>
            <Head title="Graph Message" />
            <div className="sm:items-center h-screen bg-dots-darker">
                {JSON.stringify(ctxMenuPosition || { x: null, y: null })}
                <Button>Button</Button>

                <ContextMenu position={ctxMenuPosition} onClose={closeCtxMenu} closeOnSelect={(...e) => {
                    console.log(e);
                }}>
                    {({ isOpen }) => (
                        <>
                            <MenuButton style={{ display: 'none' }} isActive={isOpen} as={Button}></MenuButton>
                            <MenuList>
                                <MenuItem command='⌘T'>New Tab</MenuItem>
                                <MenuItem command='⌘N'>New Window</MenuItem>
                                <MenuItem command='⌘⇧N'>Open Closed Tab</MenuItem>
                                <MenuItem command='⌘O'>Open File...</MenuItem>
                            </MenuList>
                        </>
                    )}
                </ContextMenu>
            </div>
        </>
    );
}

const ContextMenu = (props) => {
    const menu = useRef()

    return (
        <Menu ref={menu} {...props} isOpen={props.position} >
            {({ isOpen }) => (
                <>
                    <MenuButton style={{ display: 'none' }} isActive={isOpen} as={Button}></MenuButton>
                    <MenuList className={props.position ? 'ctx-visible' : 'ctx-hidden'} style={{
                        position: 'fixed',
                        zIndex: 9999,
                        top: props.position?.y,
                        left: props.position?.x
                    }}>
                        <MenuItem command='⌘T'>New Tab</MenuItem>
                        <MenuItem command='⌘N'>New Window</MenuItem>
                        <MenuItem command='⌘⇧N'>Open Closed Tab</MenuItem>
                        <MenuItem command='⌘O'>Open File...</MenuItem>
                    </MenuList>
                </>
            )}
        </Menu>
    )
}