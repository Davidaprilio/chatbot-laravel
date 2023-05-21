import ContextMenu from '@/Components/ContextMenu';
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

                <ContextMenu position={ctxMenuPosition} onClose={closeCtxMenu}>
                    <MenuItem onClick={() => console.log('New Tab')} command='⌘T'>New Tab</MenuItem>
                    <MenuItem onClick={() => console.log('New Window')} command='⌘N'>New Window</MenuItem>
                    <MenuItem onClick={() => console.log('Open Closed')} command='⌘⇧N'>Open Closed Tab</MenuItem>
                    <MenuItem onClick={() => console.log('Open File')} command='⌘O'>Open File...</MenuItem>
                </ContextMenu>
            </div>
        </>
    );
}
