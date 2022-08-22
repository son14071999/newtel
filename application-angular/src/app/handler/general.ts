import * as _ from 'lodash';

export class General {

    // đánh stt cho objects
    indexing(objects: any) {
        _.map(objects, (item, key) => {
            item.stt = key + 1
            return item
        })
        return objects
    }
}
