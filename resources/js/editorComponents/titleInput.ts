export function useToastUICustomTitleInput({placeholder = 'Insérer un titre', initialValue, onUpdate} : { placeholder? : string, initialValue? : string, onUpdate: (a:string) => void}) : HTMLInputElement {
    const input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('placeholder', placeholder);
    input.value = initialValue ?? '';
    input.className = 'toastui-editor-toolbar-icons bg-white text-black rounded-sm border-2 px-2 border-slate-200';
    input.style.backgroundImage = 'none';
    input.style.margin = '0';

    input.addEventListener('input', (e) => onUpdate((e.target as HTMLInputElement).value));
    return input;
}