import React, {
    createContext,
    useCallback,
    useContext,
    useRef,
    useState
} from "react"
import {
    AlertDialog,
    AlertDialogBody,
    AlertDialogContent,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogOverlay,
    Button,
    Flex,
    Input,
    Stack,
    Text
} from "@chakra-ui/react"

var DialogType
(function (DialogType) {
    DialogType[(DialogType["Alert"] = 0)] = "Alert"
    DialogType[(DialogType["Confirm"] = 1)] = "Confirm"
    DialogType[(DialogType["Prompt"] = 2)] = "Prompt"
})(DialogType || (DialogType = {}))

/**
 * @typedef {Object} OptionsAlert
 * @property {string} [title]
 * @property {import("@chakra-ui/react").TextProps} [titleProps]
 * @property {string} [message]
 * @property {import("@chakra-ui/react").TextProps} [messageProps={ fontSize: 'md' }]
 * @property {string} [okText]
 * @property {import("@chakra-ui/react").ButtonProps} [okButtonProps={ colorScheme: 'blue' }]
 * @property {string} [cancelText]
 * @property {import("@chakra-ui/react").ButtonProps} [cancelButtonProps={ variant: 'ghost' }]
 * @property {import("@chakra-ui/react").AlertDialogProps} [alertDialogProps]
 * 
 */

/**
 * @typedef {Object} DialogOptons
 * @property {(opts: OptionsAlert) => Promise<void>} alert
 * @property {(opts: OptionsAlert) => Promise<boolean>} confirm
 * @property {(opts: OptionsAlert) => Promise<string | null>} prompt
 * 
 */

/**
 * @type {DialogOptons}
 */
const defaultContext = {
    alert() {
        throw new Error("<ModalProvider> is missing")
    },
    confirm() {
        throw new Error("<ModalProvider> is missing")
    },
    prompt() {
        throw new Error("<ModalProvider> is missing")
    }
}

const Context = createContext(defaultContext)

export const AlertDialogProvider = ({ children }) => {
    const [alert, setAlert] = useState(null)
    const input = useRef(null)
    const ok = useRef(null)

    const createOpener = useCallback(
        type => (opts) =>
            new Promise(resolve => {
                const handleClose = e => {
                    e?.preventDefault()
                    setAlert(null)
                    resolve(null)
                }

                const handleCancel = e => {
                    e?.preventDefault()
                    setAlert(null)
                    if (type === DialogType.Prompt) resolve(null)
                    else resolve(false)
                }

                const handleOK = e => {
                    e?.preventDefault()
                    setAlert(null)
                    if (type === DialogType.Prompt) resolve(input.current?.value)
                    else resolve(true)
                }

                setAlert(
                    <AlertDialog
                        isOpen={true}
                        onClose={handleClose}
                        initialFocusRef={type === DialogType.Prompt ? input : ok}
                        {...opts.alertDialogProps}
                    >
                        <AlertDialogOverlay>
                            <AlertDialogContent>
                                <AlertDialogHeader fontSize='lg' fontWeight='bold' {...opts.titleProps || {}}>
                                    {opts.title || 'Are you sure?'}
                                </AlertDialogHeader>

                                <AlertDialogBody>
                                    <Flex gap={4} alignItems="center">
                                        {opts.icon}
                                        <Stack spacing={5}>
                                            {opts.message && (
                                                <Text fontSize='md' {...opts.messageProps || {}}>
                                                    {opts.message}
                                                </Text>
                                            )}
                                            {type === DialogType.Prompt && (
                                                <Input ref={input} defaultValue={opts.defaultValue || ''} />
                                            )}
                                        </Stack>
                                    </Flex>
                                </AlertDialogBody>

                                <AlertDialogFooter>
                                    {type !== DialogType.Alert && (
                                        <Button
                                            mr={3}
                                            variant="ghost"
                                            onClick={handleCancel}
                                            {...opts.cancelButtonProps || {}}
                                        >
                                            {opts.cancelText || 'Cancel'}
                                        </Button>
                                    )}
                                    <Button onClick={handleOK} ref={ok} colorScheme="blue" {...opts.okButtonProps || {}}>
                                        {opts.okText || 'OK'}
                                    </Button>
                                </AlertDialogFooter>
                            </AlertDialogContent>
                        </AlertDialogOverlay>
                    </AlertDialog>
                )
            }),
        [children]
    )

    return (
        <Context.Provider
            value={{
                alert: createOpener(DialogType.Alert),
                confirm: createOpener(DialogType.Confirm),
                prompt: createOpener(DialogType.Prompt)
            }}
        >
            {children}
            {alert}
        </Context.Provider>
    )
}

const useDialog = () => useContext(Context)

export default useDialog
