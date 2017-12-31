
// Append origin data to manifest before clear
let originData = Mix.manifest.read();
for (let filePath in originData) {
    if (originData.hasOwnProperty(filePath)) {
        Mix.manifest.add(originData[filePath]);
    }
}
